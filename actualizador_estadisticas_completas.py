import requests
import mysql.connector
import time
from unidecode import unidecode

try:
    conexion = mysql.connector.connect(host="127.0.0.1", user="analista", password="futbol_password", database="laliga_db", port=3306)
    cursor = conexion.cursor()
except Exception as e:
    print(f"[ERROR] Fallo conectando a MariaDB: {e}")
    exit()

headers = {'x-apisports-key': 'd42a18ffbed595961d3e85396ed1d753', 'x-rapidapi-host': 'v3.football.api-sports.io'}

print("=== LIMPIANDO JUGADORES (BORRANDO FANTASMAS Y ERRORES) ===")
cursor.execute("SET FOREIGN_KEY_CHECKS = 0;")
cursor.execute("TRUNCATE TABLE estadisticas_campo;")
cursor.execute("TRUNCATE TABLE jugadores;")
cursor.execute("SET FOREIGN_KEY_CHECKS = 1;")
conexion.commit()

print("=== SINCRONIZANDO PARTIDOS REALES (LALIGA 24/25) ESTRICTO ===")
cursor.execute("SELECT id_equipo, nombre FROM equipos")
equipos = cursor.fetchall()

for equipo in equipos:
    id_equipo, nombre_equipo = equipo[0], equipo[1]
    print(f"\n[+] Extrayendo datos de: {nombre_equipo}")
    
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
            nombre = unidecode(item['player']['firstname'] or "Desconocido")
            apellidos = unidecode(item['player']['lastname'] or "")
            foto = item['player']['photo']
            nacionalidad = item['player'].get('nationality', 'Desconocido')
            
            goles = 0; asistencias = 0; partidos = 0
            posicion_api = "Desconocido"
            es_valido_para_este_equipo = False
            
            for stat in item.get('statistics', []):
                liga = stat.get('league', {})
                equipo_stat = stat.get('team', {})
                
                # EL FILTRO MÁGICO: Liga 140, Temp 2024, Y el equipo TIENE QUE COINCIDIR EXACTAMENTE
                if str(liga.get('id')) == "140" and str(liga.get('season')) == "2024" and str(equipo_stat.get('id')) == str(id_equipo):
                    es_valido_para_este_equipo = True
                    
                    g = stat.get('goals', {}).get('total')
                    if g: goles += int(g)
                    
                    a = stat.get('goals', {}).get('assists')
                    if a: asistencias += int(a)
                    
                    p = stat.get('games', {}).get('lineups')
                    if p: partidos += int(p)
                    
                    if posicion_api == "Desconocido":
                        posicion_api = stat.get('games', {}).get('position') or "Desconocido"
                        
            # SOLO insertamos si las estadísticas de 2024 corresponden a ESTE equipo
            if es_valido_para_este_equipo and posicion_api != "Desconocido":
                sql_jug = """INSERT INTO jugadores (id_jugador, id_equipo, nombre, apellidos, foto, posicion, nacionalidad, partidos_jugados) 
                             VALUES (%s, %s, %s, %s, %s, %s, %s, %s) 
                             ON DUPLICATE KEY UPDATE 
                             id_equipo = VALUES(id_equipo), foto = VALUES(foto), nombre = VALUES(nombre), apellidos = VALUES(apellidos), posicion = VALUES(posicion), nacionalidad = VALUES(nacionalidad), partidos_jugados = VALUES(partidos_jugados)"""
                cursor.execute(sql_jug, (id_jugador, id_equipo, nombre, apellidos, foto, posicion_api, nacionalidad, partidos))
                
                sql_stats = """INSERT INTO estadisticas_campo (id_jugador, goles, asistencias) VALUES (%s, %s, %s) 
                               ON DUPLICATE KEY UPDATE goles = VALUES(goles), asistencias = VALUES(asistencias)"""
                cursor.execute(sql_stats, (id_jugador, goles, asistencias))
            
        conexion.commit()
        print(f"   [OK] Pagina {pagina_actual} guardada correctamente.")
        time.sleep(6.5)
        pagina_actual += 1

cursor.close()
conexion.close()
print("\n[EXITO] Extraccion finalizada sin jugadores fantasma.")
