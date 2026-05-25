import requests
import mysql.connector
import time
from unidecode import unidecode

# Intento conectarme localmente a mi contenedor de MariaDB por su puerto por defecto
try:
    conexion = mysql.connector.connect(host="127.0.0.1", user="analista", password="futbol_password", database="laliga_db", port=3306)
    cursor = conexion.cursor()
except Exception as e:
    print(f"[ERROR] Fallo conectando a MariaDB: {e}")
    exit()

# Meto mis credenciales privadas para autenticarme contra la API de fútbol
headers = {'x-apisports-key': 'd42a18ffbed595961d3e85396ed1d753', 'x-rapidapi-host': 'v3.football.api-sports.io'}

# Ejecuto un vaciado completo de las tablas antes de rellenar.
# Así me aseguro de que si un jugador ha sido traspasado, no se quede duplicado ("fantasma") en la DB.
print("=== LIMPIANDO JUGADORES (BORRANDO FANTASMAS Y ERRORES) ===")
cursor.execute("SET FOREIGN_KEY_CHECKS = 0;") # Desactivo llaves foráneas para poder hacer el TRUNCATE limpio
cursor.execute("TRUNCATE TABLE estadisticas_campo;")
cursor.execute("TRUNCATE TABLE jugadores;")
cursor.execute("SET FOREIGN_KEY_CHECKS = 1;") # Las vuelvo a activar por seguridad
conexion.commit()

print("=== SINCRONIZANDO PARTIDOS REALES (LALIGA 24/25) ESTRICTO ===")
# Saco la lista de los equipos que tengo guardados para ir pidiendo los datos uno por uno
cursor.execute("SELECT id_equipo, nombre FROM equipos")
equipos = cursor.fetchall()

for equipo in equipos:
    id_equipo, nombre_equipo = equipo[0], equipo[1]
    print(f"\n[+] Extrayendo datos de: {nombre_equipo}")
    
    # Controlo la paginación de la API para no saturar y traer la lista completa del club
    pagina_actual = 1
    total_paginas = 1
    while pagina_actual <= total_paginas and pagina_actual <= 3:
        url = f"https://v3.football.api-sports.io/players?team={id_equipo}&league=140&season=2024&page={pagina_actual}"
        respuesta = requests.get(url, headers=headers).json()
        
        if respuesta.get('errors'):
            print(f"   [!] ERROR: {respuesta['errors']}")
            break
            
        total_paginas = respuesta.get('paging', {}).get('total', 1)
        jugadores = respuesta.get('response', [])
        
        for item in jugadores:
            id_jugador = item['player']['id']
            # Uso unidecode para limpiar tildes y caracteres raros de nombres extranjeros.
            # Esto me ahorra problemas extraños de codificación en la base de datos.
            nombre = unidecode(item['player']['firstname'] or "Desconocido")
            apellidos = unidecode(item['player']['lastname'] or "")
            foto = item['player']['photo']
            nacionalidad = item['player'].get('nationality', 'Desconocido')
            
            goles = 0; asistencias = 0; partidos = 0
            posicion_api = "Desconocido"
            es_valido_para_este_equipo = False
            
            # Recorro el historial que me da la API para filtrar las estadísticas actuales
            for stat in item.get('statistics', []):
                liga = stat.get('league', {})
                equipo_stat = stat.get('team', {})
                
                # MI FILTRO MÁGICO: Compruebo de forma estricta que la liga sea la de España (140),
                # la temporada sea la 2024 y que el ID del equipo coincida al 100% con el que estoy buscando.
                if str(liga.get('id')) == "140" and str(liga.get('season')) == "2024" and str(equipo_stat.get('id')) == str(id_equipo):
                    es_valido_para_este_equipo = True
                    
                    # Voy sumando las métricas que saca el bucle para acumularlas
                    g = stat.get('goals', {}).get('total')
                    if g: goles += int(g)
                    
                    a = stat.get('goals', {}).get('assists')
                    if a: asistencias += int(a)
                    
                    p = stat.get('games', {}).get('lineups')
                    if p: partidos += int(p)
                    
                    if posicion_api == "Desconocido":
                        posicion_api = stat.get('games', {}).get('position') or "Desconocido"
                        
            # Si el filtro confirma que el jugador pertenece a este club en la 24/25, lo guardo
            if es_valido_para_este_equipo and posicion_api != "Desconocido":
                # Si por algún motivo el ID ya existe, aplico un UPDATE para mantener los campos al día
                sql_jug = """INSERT INTO jugadores (id_jugador, id_equipo, nombre, apellidos, foto, posicion, nacionalidad, partidos_jugados) 
                             VALUES (%s, %s, %s, %s, %s, %s, %s, %s) 
                             ON DUPLICATE KEY UPDATE 
                             id_equipo = VALUES(id_equipo), foto = VALUES(foto), nombre = VALUES(nombre), apellidos = VALUES(apellidos), posicion = VALUES(posicion), nacionalidad = VALUES(nacionalidad), partidos_jugados = VALUES(partidos_jugados)"""
                cursor.execute(sql_jug, (id_jugador, id_equipo, nombre, apellidos, foto, posicion_api, nacionalidad, partidos))
                
                # Relleno de forma paralela la tabla relacional de rendimiento de campo
                sql_stats = """INSERT INTO estadisticas_campo (id_jugador, goles, asistencias) VALUES (%s, %s, %s) 
                               ON DUPLICATE KEY UPDATE goles = VALUES(goles), asistencias = VALUES(asistencias)"""
                cursor.execute(sql_stats, (id_jugador, goles, asistencias))
            
        conexion.commit() # Consolido los datos en mi volumen por cada página completada
        print(f"   [OK] Pagina {pagina_actual} guardada correctamente.")
        # Duermo el script 6.5 segundos entre llamadas para cumplir rígidamente con el límite de peticiones de la API gratis
        time.sleep(6.5)
        pagina_actual += 1

cursor.close()
conexion.close()
print("\n[EXITO] Extraccion finalizada sin jugadores fantasma.")
