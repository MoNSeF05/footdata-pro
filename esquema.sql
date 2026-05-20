CREATE TABLE IF NOT EXISTS equipos (
    id_equipo INT PRIMARY KEY,
    nombre VARCHAR(100),
    estadio VARCHAR(100),
    entrenador VARCHAR(100),
    foto_entrenador VARCHAR(255),
    kit_local_color_1 VARCHAR(20),
    kit_visit_color_1 VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS jugadores (
    id_jugador INT PRIMARY KEY,
    id_equipo INT,
    nombre VARCHAR(100),
    apellidos VARCHAR(100),
    foto VARCHAR(255),
    nacionalidad VARCHAR(50),
    posicion VARCHAR(50),
    partidos_jugados INT,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo)
);

CREATE TABLE IF NOT EXISTS estadisticas_campo (
    id_jugador INT PRIMARY KEY,
    goles INT DEFAULT 0,
    asistencias INT DEFAULT 0,
    FOREIGN KEY (id_jugador) REFERENCES jugadores(id_jugador)
);

-- Insertamos los 20 equipos de LaLiga para que el Python pueda hacer el bucle
INSERT IGNORE INTO equipos (id_equipo, nombre, estadio) VALUES
(541, 'Real Madrid', 'Santiago Bernabeu'), 
(529, 'FC Barcelona', 'Camp Nou'), 
(530, 'Atletico Madrid', 'Metropolitano'),
(531, 'Athletic Club', 'San Mames'), 
(548, 'Real Sociedad', 'Reale Arena'), 
(543, 'Real Betis', 'Benito Villamarin'),
(533, 'Villarreal', 'La Ceramica'), 
(532, 'Valencia', 'Mestalla'), 
(536, 'Sevilla', 'Ramon Sanchez Pizjuan'),
(727, 'Osasuna', 'El Sadar'), 
(539, 'Las Palmas', 'Gran Canaria'), 
(547, 'Alaves', 'Mendizorroza'),
(538, 'Celta Vigo', 'Balaidos'), 
(798, 'Mallorca', 'Son Moix'), 
(546, 'Getafe', 'Coliseum'),
(534, 'Girona', 'Montilivi'), 
(728, 'Rayo Vallecano', 'Vallecas'), 
(537, 'Leganes', 'Butarque'),
(720, 'Valladolid', 'Jose Zorrilla'), 
(540, 'Espanyol', 'RCDE Stadium');
