<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>FootData Pro | Estadísticas y Datos de LALIGA EA SPORTS 24/25</title>
    <meta name="description" content="Análisis avanzado, estadísticas de fútbol, pichichis, asistentes y plantillas completas de LALIGA EA SPORTS 2024/2025. Datos en tiempo real.">
    <meta name="keywords" content="futbol, laliga, datos de futbol, estadisticas futbol, pichichi, asistencias, clasificacion, primera division, 24/25, real madrid, barcelona, atletico, resultados, plantillas, once titular">
    <meta name="author" content="Monsef - TFG ASIR">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Spanish">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="FootData Pro | Datos en tiempo real de LALIGA">
    <meta property="og:description" content="Toda la información, onces titulares y plantillas de la liga española en tiempo real 24/25.">
    <meta property="og:image" content="https://media.api-sports.io/football/leagues/140.png">
    <meta property="og:url" content="https://footdata.duckdns.org">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="FootData Pro | LALIGA 24/25">
    <meta name="twitter:description" content="Estadísticas avanzadas y datos de fútbol en tiempo real.">
    <meta name="twitter:image" content="https://media.api-sports.io/football/leagues/140.png">
    <link rel="icon" href="https://media.api-sports.io/football/leagues/140.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script>
        const temaGuardado = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', temaGuardado);
    </script>
    <style>
        :root { --laliga-red: #ee3124; --laliga-dark: #111; }
        body { font-family: 'Inter', sans-serif; transition: background-color 0.3s, color 0.3s; }
        *:focus-visible { outline: 3px solid var(--laliga-red) !important; outline-offset: 2px; }
        .club-bar { background: #000; padding: 12px 0; overflow-x: auto; white-space: nowrap; -webkit-overflow-scrolling: touch; }
        .club-bar img { height: 32px; margin: 0 15px; transition: transform 0.3s ease; }
        .club-bar img:hover { transform: scale(1.2); } 
        .main-header { padding: 30px 0; border-bottom: 1px solid var(--bs-border-color); background-color: var(--bs-body-bg); }
        .brand-name { color: var(--laliga-red); font-weight: 900; font-size: clamp(30px, 5vw, 45px); letter-spacing: -2px; }
        .hero-section { background: linear-gradient(135deg, #ee3124 0%, #b1130a 100%); color: white; padding: 60px 0; border-radius: 0 0 50px 50px; margin-bottom: 40px; }
        .nav-laliga .nav-link { color: var(--bs-body-color); font-weight: 700; text-transform: uppercase; font-size: 14px; padding: 15px 25px !important; border-bottom: 4px solid transparent; }
        .nav-link.active { color: var(--laliga-red) !important; border-bottom: 4px solid var(--laliga-red) !important; }
        .card-stat-modern { position: relative; width: 100%; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15); transition: 0.3s; margin-top: 20px; background: #222; border: 2px solid var(--bs-border-color); height: 420px; }
        .card-stat-modern:hover { transform: translateY(-5px); }
        .player-bg-photo { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.7) contrast(1.2); }
        .card-gradient-overlay { position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0) 100%); z-index: 1; }
        .data-card { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; background: var(--bs-secondary-bg) !important; }
        .badge-abs { position: absolute; top: 20px; left: 20px; background: var(--laliga-red); color: white; font-size: 11px; font-weight: 900; padding: 6px 12px; border-radius: 20px; z-index: 2; }
        .value-abs { position: absolute; top: 15px; right: 20px; font-size: 80px; font-weight: 900; color: #fff; z-index: 2; }
        .player-info-abs { position: absolute; bottom: 25px; left: 25px; right: 25px; z-index: 2; }
        .featured-abs { font-size: 26px; color: white; font-weight: 900; text-transform: uppercase; }
        .tactical-board { position: relative; width: 100%; max-width: 450px; height: 550px; background: linear-gradient(180deg, #2e7d32 0%, #276b2a 100%); margin: 0 auto; border: 3px solid #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        .pitch-line-center { position: absolute; top: 50%; left: 0; width: 100%; height: 2px; background: rgba(255,255,255,0.6); }
        .pitch-circle { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100px; height: 100px; border: 2px solid rgba(255,255,255,0.6); border-radius: 50%; }
        .player-node { position: absolute; transform: translate(-50%, -50%); width: 44px; height: 44px; border-radius: 50%; background: #fff; border: 2px solid var(--laliga-red); box-shadow: 0 4px 6px rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 10; transition: 0.2s; cursor: pointer; }
        .player-node img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
        .player-name-tag { position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.8); color: #fff; font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 4px; white-space: nowrap; }
        .team-banner { background: linear-gradient(135deg, var(--laliga-dark) 0%, #333 100%); border-radius: 20px; padding: 40px; color: white; position: relative; }
        .kit-container { position: relative; width: 100px; height: 100px; margin: 0 auto; display: flex; align-items: center; justify-content: center; background: var(--bs-tertiary-bg); border-radius: 10px; border: 1px solid var(--bs-border-color); }
        .player-photo { width: 45px; height: 45px; object-fit: cover; border-radius: 50%; border: 2px solid var(--bs-border-color); background: #fff; }
        .flag-icon { width: 20px; height: 14px; border-radius: 2px; margin-right: 8px; object-fit: cover; vertical-align: middle; box-shadow: 0 1px 2px rgba(0,0,0,0.1); }
        .btn-theme-toggle { border-radius: 50px; padding: 5px 15px; font-weight: bold; }
    </style>
</head>
<body class="bg-body text-body">

<?php
$conn = new mysqli("db", "analista", "futbol_password", "laliga_db");
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'inicio';

$paises_data = [
    'Spain' => ['es', 'España'], 'France' => ['fr', 'Francia'], 'Brazil' => ['br', 'Brasil'], 
    'Argentina' => ['ar', 'Argentina'], 'Portugal' => ['pt', 'Portugal'], 'Germany' => ['de', 'Alemania'], 
    'Belgium' => ['be', 'Bélgica'], 'Netherlands' => ['nl', 'Países Bajos'], 'England' => ['gb-eng', 'Inglaterra'], 
    'Uruguay' => ['uy', 'Uruguay'], 'Croatia' => ['hr', 'Croacia'], 'Norway' => ['no', 'Noruega'],
    'Puerto Rico' => ['pr', 'Puerto Rico'], 'Mozambique' => ['mz', 'Mozambique'], 'Colombia' => ['co', 'Colombia'],
    'Venezuela' => ['ve', 'Venezuela'], 'Mali' => ['ml', 'Mali'], 'Slovenia' => ['si', 'Eslovenia'],
    'USA' => ['us', 'Estados Unidos'], 'Canada' => ['ca', 'Canadá'], 'Romania' => ['ro', 'Rumania'],
    'Cyprus' => ['cy', 'Chipre'], 'Italy' => ['it', 'Italia'], 'Ghana' => ['gh', 'Ghana'],
    'Serbia' => ['rs', 'Serbia'], 'Equatorial Guinea' => ['gq', 'Guinea Ecuatorial'],
    'Morocco' => ['ma', 'Marruecos'], 'Senegal' => ['sn', 'Senegal'], 'Ukraine' => ['ua', 'Ucrania'],
    'Poland' => ['pl', 'Polonia'], "Cote d'Ivoire" => ['ci', 'Costa de Marfil'], 'Cameroon' => ['cm', 'Camerún'],
    'Nigeria' => ['ng', 'Nigeria'], 'Switzerland' => ['ch', 'Suiza'], 'Denmark' => ['dk', 'Dinamarca'],
    'Sweden' => ['se', 'Suecia'], 'Japan' => ['jp', 'Japón'], 'South Korea' => ['kr', 'Corea del Sur'],
    'Mexico' => ['mx', 'México'], 'Algeria' => ['dz', 'Argelia'], 'Tunisia' => ['tn', 'Túnez'],
    'Guinea' => ['gn', 'Guinea'], 'Gabon' => ['ga', 'Gabón'], 'Austria' => ['at', 'Austria'],
    'Czech Republic' => ['cz', 'República Checa'], 'Slovakia' => ['sk', 'Eslovaquia'], 'Hungary' => ['hu', 'Hungría'],
    'Turkey' => ['tr', 'Turquía'], 'Georgia' => ['ge', 'Georgia'], 'Albania' => ['al', 'Albania'],
    'Greece' => ['gr', 'Grecia'], 'Israel' => ['il', 'Israel'], 'Montenegro' => ['me', 'Montenegro'],
    'Paraguay' => ['py', 'Paraguay'], 'Chile' => ['cl', 'Chile'], 'Peru' => ['pe', 'Perú']
];

function obtenerBandera($paisIngles, $data) {
    $code = $data[$paisIngles][0] ?? 'un';
    return "https://flagcdn.com/w40/$code.png";
}

function traducirPais($paisIngles, $data) {
    return $data[$paisIngles][1] ?? $paisIngles;
}
?>

<nav class="club-bar text-center" aria-label="Selección de club">
    <div class="container">
        <?php 
        $ids = [541, 529, 530, 531, 548, 543, 533, 532, 536, 727, 538, 728, 798, 546, 547, 542, 534, 537, 720, 540]; 
        foreach ($ids as $id) { 
            echo "<a href='?tab=equipo_detalle&id=$id'><img src='https://media.api-sports.io/football/teams/$id.png' alt='Escudo Club LALIGA'></a>"; 
        } 
        ?>
    </div>
</nav>

<header class="main-header text-center">
    <div class="brand-name">FOOTDATA</div>
    <div class="fw-bold text-muted small">TEMPORADA 2024/25 | INFRAESTRUCTURA GOOGLE CLOUD</div>
</header>

<nav class="nav-laliga shadow-sm">
    <div class="container d-flex justify-content-center align-items-center">
        <ul class="nav flex-nowrap overflow-auto align-items-center">
            <li class="nav-item"><a class="nav-link <?php echo ($tab == 'inicio') ? 'active' : ''; ?>" href="?tab=inicio">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($tab == 'goleadores') ? 'active' : ''; ?>" href="?tab=goleadores">Goleadores</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($tab == 'asistentes') ? 'active' : ''; ?>" href="?tab=asistentes">Asistentes</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($tab == 'equipos' || $tab == 'equipo_detalle') ? 'active' : ''; ?>" href="?tab=equipos">Equipos</a></li>
            <li class="nav-item ms-3">
                <button id="themeToggleBtn" class="btn btn-outline-secondary btn-theme-toggle" aria-label="Cambiar tema">
                    <i class="fa-solid fa-moon"></i>
                </button>
            </li>
        </ul>
    </div>
</nav>

<main>
    <?php if ($tab == 'inicio'): ?>
        <section class="hero-section text-center"><div class="container"><h1 class="display-4 fw-bold">Análisis 24/25 📊</h1><p class="lead">Datos procesados en tiempo real vía API-Football</p></div></section>
        <div class="container mb-5">
            <div class="row g-4">
                <?php 
                $res_g = $conn->query("SELECT j.nombre, j.apellidos, j.foto, e.nombre as equipo, c.goles FROM jugadores j JOIN estadisticas_campo c ON j.id_jugador = c.id_jugador JOIN equipos e ON j.id_equipo = e.id_equipo ORDER BY c.goles DESC LIMIT 1");
                $top_g = $res_g ? $res_g->fetch_assoc() : null;
                
                $res_a = $conn->query("SELECT j.nombre, j.apellidos, j.foto, e.nombre as equipo, c.asistencias FROM jugadores j JOIN estadisticas_campo c ON j.id_jugador = c.id_jugador JOIN equipos e ON j.id_equipo = e.id_equipo ORDER BY c.asistencias DESC LIMIT 1");
                $top_a = $res_a ? $res_a->fetch_assoc() : null;
                
                $res_t = $conn->query("SELECT COUNT(*) as total FROM jugadores"); 
                $total = $res_t ? $res_t->fetch_assoc() : ['total' => 0];
                ?>
                <div class="col-12 col-md-4">
                    <div class="card-stat-modern">
                        <img src="<?php echo $top_g['foto'] ?? 'https://ui-avatars.com/api/?name=ND'; ?>" class="player-bg-photo" alt="Máximo goleador de LaLiga" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($top_g['nombre'] ?? 'ND'); ?>&amp;background=random';">
                        <div class="card-gradient-overlay"></div>
                        <span class="badge-abs">🏆 PICHICHI</span>
                        <div class="value-abs"><?php echo $top_g['goles'] ?? 0; ?> ⚽</div>
                        <div class="player-info-abs">
                            <div class="featured-abs"><?php echo isset($top_g['nombre']) ? $top_g['nombre'].' '.$top_g['apellidos'] : 'Sin datos'; ?></div>
                            <span class="badge bg-danger"><?php echo $top_g['equipo'] ?? '-'; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card-stat-modern">
                        <img src="<?php echo $top_a['foto'] ?? 'https://ui-avatars.com/api/?name=ND'; ?>" class="player-bg-photo" alt="Máximo asistente de LaLiga" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($top_a['nombre'] ?? 'ND'); ?>&amp;background=random';">
                        <div class="card-gradient-overlay"></div>
                        <span class="badge-abs" style="background:#fff; color:#000;">🎯 ASISTENCIAS</span>
                        <div class="value-abs" style="color:#ee3124;"><?php echo $top_a['asistencias'] ?? 0; ?> 👟</div>
                        <div class="player-info-abs">
                            <div class="featured-abs"><?php echo isset($top_a['nombre']) ? $top_a['nombre'].' '.$top_a['apellidos'] : 'Sin datos'; ?></div>
                            <span class="badge bg-danger"><?php echo $top_a['equipo'] ?? '-'; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card-stat-modern data-card shadow-sm">
                        <span class="badge-abs" style="background:#555;">💾 BASE DE DATOS</span>
                        <div class="value-abs" style="position:static; font-size:100px; color: var(--laliga-red);"><?php echo $total['total']; ?></div>
                        <h2 class="featured-abs text-center" style="position:static; font-size:18px; color:var(--bs-body-color); margin-top:10px;">PERFILES REGISTRADOS</h2>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($tab == 'goleadores' || $tab == 'asistentes'): ?>
        <section class="container py-4">
            <h1 class="fw-bold mb-4 h2">Ranking de <?php echo ucfirst($tab == 'goleadores' ? 'goles ⚽' : 'asistencias 👟'); ?></h1>
            <div class="table-responsive shadow-sm rounded border">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark"><tr><th>#</th><th colspan="2">Jugador</th><th>Equipo</th><th class="text-center">DATO</th></tr></thead>
                    <tbody>
                        <?php 
                        $col = ($tab == 'goleadores') ? "goles" : "asistencias";
                        $sql = "SELECT j.nombre, j.apellidos, j.foto, e.nombre as equipo, c.$col FROM jugadores j JOIN estadisticas_campo c ON j.id_jugador = c.id_jugador JOIN equipos e ON j.id_equipo = e.id_equipo WHERE c.$col > 0 ORDER BY c.$col DESC LIMIT 15";
                        $res = $conn->query($sql); $i = 1; 
                        if ($res) {
                            while($f = $res->fetch_assoc()): ?>
                                <tr>
                                    <td class='fw-bold text-muted'><?php echo $i++; ?></td>
                                    <td style='width: 60px;'><img src='<?php echo $f['foto']; ?>' class='player-photo' alt='Foto de <?php echo $f['nombre']; ?>' onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($f['nombre']); ?>&amp;background=random';"></td>
                                    <td><b><?php echo $f['nombre']; ?></b><br><small><?php echo $f['apellidos']; ?></small></td>
                                    <td><?php echo $f['equipo']; ?></td>
                                    <td class='text-center fw-bold fs-4 text-danger'><?php echo $f[$col]; ?></td>
                                </tr>
                            <?php endwhile; 
                        } ?>
                    </tbody>
                </table>
            </div>
        </section>

    <?php elseif ($tab == 'equipos'): ?>
        <section class="container py-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php $res_eq = $conn->query("SELECT id_equipo, nombre, estadio FROM equipos ORDER BY nombre");
                if ($res_eq) {
                    while($eq = $res_eq->fetch_assoc()): ?>
                        <div class="col">
                            <a href="?tab=equipo_detalle&id=<?php echo $eq['id_equipo']; ?>" class="text-decoration-none text-body">
                                <div class="card h-100 shadow-sm border-0 text-center p-4 bg-body-tertiary" style="transition:0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <img src="https://media.api-sports.io/football/teams/<?php echo $eq['id_equipo']; ?>.png" alt="Escudo del <?php echo $eq['nombre']; ?>" style="height:70px; margin:auto;">
                                    <h2 class="fw-bold mt-3 mb-0 h5"><?php echo $eq['nombre']; ?></h2>
                                    <small class="text-muted">🏟️ <?php echo $eq['estadio']; ?></small>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; 
                } ?>
            </div>
        </section>

    <?php elseif ($tab == 'equipo_detalle' && isset($_GET['id'])): ?>
        <?php 
        $id_t = intval($_GET['id']);
        $res_c = $conn->query("SELECT * FROM equipos WHERE id_equipo = $id_t");
        $club = $res_c ? $res_c->fetch_assoc() : null;
        if ($club): 
            $rs_g = $conn->query("SELECT j.nombre, j.apellidos, j.foto, c.goles FROM jugadores j JOIN estadisticas_campo c ON j.id_jugador = c.id_jugador WHERE j.id_equipo = $id_t ORDER BY c.goles DESC LIMIT 1");
            $tm_g = $rs_g ? $rs_g->fetch_assoc() : null;
            $rs_a = $conn->query("SELECT j.nombre, j.apellidos, j.foto, c.asistencias FROM jugadores j JOIN estadisticas_campo c ON j.id_jugador = c.id_jugador WHERE j.id_equipo = $id_t ORDER BY c.asistencias DESC LIMIT 1");
            $tm_a = $rs_a ? $rs_a->fetch_assoc() : null;
            $trad = ['Goalkeeper'=>'Portero', 'Defender'=>'Defensa', 'Midfielder'=>'Medio', 'Attacker'=>'Delantero'];
        ?>
        <article class="container py-4">
            <div class="mb-4">
                <a href="?tab=equipos" class="btn btn-outline-danger fw-bold rounded-pill shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i> Volver a Equipos
                </a>
            </div>

            <div class="team-banner d-flex align-items-center mb-4 flex-wrap">
                <img src="https://media.api-sports.io/football/teams/<?php echo $id_t; ?>.png" alt="Escudo de <?php echo $club['nombre']; ?>" style="height:110px; background:white; border-radius:50%; padding:10px; margin-right:25px;">
                <div class="text-white"><h1 class="fw-bold mb-0"><?php echo $club['nombre']; ?></h1><p class="fs-5 mb-0 opacity-75">🏟️ <?php echo $club['estadio']; ?></p></div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-4">
                    <div class="p-3 bg-body-secondary rounded shadow-sm mb-3 border-start border-4 border-danger d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $tm_g['foto'] ?? 'https://ui-avatars.com/api/?name=ND'; ?>" class="player-photo me-2" alt="Máximo goleador de <?php echo $club['nombre']; ?>" style="width:40px; height:40px;" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($tm_g['nombre'] ?? 'ND'); ?>&amp;background=random';">
                            <div><small class="text-muted fw-bold">Máximo Goleador</small><div class="fw-bold"><?php echo isset($tm_g['nombre']) ? $tm_g['nombre'].' '.$tm_g['apellidos'] : 'Sin datos'; ?></div></div>
                        </div>
                        <span class="badge bg-danger"><?php echo $tm_g['goles'] ?? 0; ?> ⚽</span>
                    </div>
                    <div class="p-3 bg-body-secondary rounded shadow-sm mb-4 border-start border-4 border-secondary d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $tm_a['foto'] ?? 'https://ui-avatars.com/api/?name=ND'; ?>" class="player-photo me-2" alt="Máximo asistente de <?php echo $club['nombre']; ?>" style="width:40px; height:40px;" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($tm_a['nombre'] ?? 'ND'); ?>&amp;background=random';">
                            <div><small class="text-muted fw-bold">Máximo Asistente</small><div class="fw-bold"><?php echo isset($tm_a['nombre']) ? $tm_a['nombre'].' '.$tm_a['apellidos'] : 'Sin datos'; ?></div></div>
                        </div>
                        <span class="badge bg-secondary"><?php echo $tm_a['asistencias'] ?? 0; ?> 👟</span>
                    </div>

                    <div class="card bg-body-secondary border-0 shadow-sm p-4 mb-4">
                        <h2 class="text-muted fw-bold mb-3 h6">ENTRENADOR 👔</h2>
                        <div class="d-flex align-items-center">
                            <span class="fw-bold fs-5 text-primary">
                                <i class="fa-solid fa-user-tie me-2"></i>
                                <?php echo $club['entrenador'] ?: 'Sin datos'; ?>
                            </span>
                        </div>
                    </div>

                    <div class="card bg-body-secondary border-0 shadow-sm p-4 text-center">
                        <h2 class="text-muted fw-bold mb-4 h6">EQUIPACIONES 👕</h2>
                        <div class="d-flex justify-content-around">
                            <div><div class="kit-container"><i class="fa-solid fa-shirt" style="font-size:4rem; color:<?php echo $club['kit_local_color_1'] ?: '#000'; ?>;"></i></div><p class="small fw-bold mt-2">LOCAL</p></div>
                            <div><div class="kit-container"><i class="fa-solid fa-shirt" style="font-size:4rem; color:<?php echo $club['kit_visit_color_1'] ?: '#000'; ?>;"></i></div><p class="small fw-bold mt-2">VISITANTE</p></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="card bg-body-secondary border-0 shadow-sm p-4 mb-4">
                        <h2 class="fw-bold mb-4 border-bottom pb-2 h5">♟️ XI Titular (Por titularidades reales)</h2>
                        <div class="tactical-board">
                            <div class="pitch-line-center"></div><div class="pitch-circle"></div>
                            <?php 
                            $sql_p = "SELECT j.*, COALESCE(e.goles,0) as g, COALESCE(e.asistencias,0) as a FROM jugadores j LEFT JOIN estadisticas_campo e ON j.id_jugador = e.id_jugador WHERE j.id_equipo = $id_t ORDER BY j.partidos_jugados DESC";
                            $res_p = $conn->query($sql_p); $xi = []; $gk = []; $df = []; $md = []; $at = [];
                            if ($res_p) {
                                while($p = $res_p->fetch_assoc()) {
                                    if ($p['posicion'] == 'Goalkeeper' && count($gk) < 1) $gk[] = $p;
                                    elseif ($p['posicion'] == 'Defender' && count($df) < 4) $df[] = $p;
                                    elseif ($p['posicion'] == 'Midfielder' && count($md) < 3) $md[] = $p;
                                    elseif ($p['posicion'] == 'Attacker' && count($at) < 3) $at[] = $p;
                                }
                                $xi = array_merge($gk, $df, $md, $at);
                                $coords = [['t'=>'88%','l'=>'50%'],['t'=>'70%','l'=>'15%'],['t'=>'75%','l'=>'35%'],['t'=>'75%','l'=>'65%'],['t'=>'70%','l'=>'85%'],['t'=>'50%','l'=>'25%'],['t'=>'55%','l'=>'50%'],['t'=>'50%','l'=>'75%'],['t'=>'25%','l'=>'20%'],['t'=>'20%','l'=>'50%'],['t'=>'25%','l'=>'80%']];
                                foreach($xi as $i => $pj) {
                                    $n_es = traducirPais($pj['nacionalidad'], $paises_data);
                                    $bandera = obtenerBandera($pj['nacionalidad'], $paises_data);
                                    $pos_trad = $trad[$pj['posicion']] ?? $pj['posicion'];
                                    
                                    $pop = "<strong>Posición:</strong> " . $pos_trad . "<br><strong>País:</strong> <img src='" . $bandera . "' class='flag-icon' alt='Bandera'> " . $n_es . "<hr class='my-1'><strong>Goles:</strong> " . $pj['g'] . " | <strong>Asist:</strong> " . $pj['a'] . "<br><strong>Titularidades:</strong> " . $pj['partidos_jugados'];
                                    
                                    $apellidos_arr = explode(' ', trim($pj['apellidos']));
                                    $primer_apellido = $apellidos_arr[0] ?? '';
                                    $nombre_corto = substr($pj['nombre'], 0, 1) . ". " . $primer_apellido;
                                    
                                    $fallback = "https://ui-avatars.com/api/?name=" . urlencode($nombre_corto) . "&amp;background=random";
                                    $safe_title = htmlspecialchars($pj['nombre'] . " " . $pj['apellidos'], ENT_QUOTES);
                                    $safe_pop = htmlspecialchars($pop, ENT_QUOTES);
                                    
                                    echo '<div class="player-node" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-html="true" style="top:' . $coords[$i]['t'] . '; left:' . $coords[$i]['l'] . ';" title="' . $safe_title . '" data-bs-content="' . $safe_pop . '">';
                                    echo '<img src="' . $pj['foto'] . '" alt="Jugador ' . $nombre_corto . '" onerror="this.onerror=null; this.src=\'' . $fallback . '\';">';
                                    echo '<div class="player-name-tag">' . $nombre_corto . '</div>';
                                    echo '</div>';
                                }
                            } ?>
                        </div>
                    </div>

                    <div class="card bg-body-secondary border-0 shadow-sm p-4">
                        <h2 class="fw-bold border-bottom pb-2 mb-4 h5">👥 Plantilla Completa</h2>
                        <div class="table-responsive">
                            <table id="miPlantilla" class="table table-hover align-middle w-100">
                                <thead class="table-light"><tr><th>Jugador</th><th>Nacionalidad</th><th>Posición</th><th>Goles</th><th>Asist.</th><th>Titular.</th></tr></thead>
                                <tbody>
                                    <?php 
                                    $res_all = $conn->query($sql_p); 
                                    if ($res_all) {
                                        while($j = $res_all->fetch_assoc()): 
                                            $n_es = traducirPais($j['nacionalidad'], $paises_data);
                                            $bandera = obtenerBandera($j['nacionalidad'], $paises_data);
                                        ?>
                                        <tr>
                                            <td><img src="<?php echo $j['foto']; ?>" class="player-photo me-2" alt="Foto perfil de <?php echo $j['nombre']; ?>" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($j['nombre']); ?>&amp;background=random';"><b><?php echo $j['nombre'].' '.$j['apellidos']; ?></b></td>
                                            <td><img src="<?php echo $bandera; ?>" class='flag-icon' alt="Bandera de <?php echo $n_es; ?>"> <?php echo $n_es; ?></td>
                                            <td><span class="badge text-bg-secondary"><?php echo $trad[$j['posicion']] ?? $j['posicion']; ?></span></td>
                                            <td class="text-center"><?php echo $j['g']; ?></td><td class="text-center"><?php echo $j['a']; ?></td><td class="text-center fw-bold"><?php echo $j['partidos_jugados']; ?></td>
                                        </tr>
                                        <?php endwhile; 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <?php endif; ?>
    <?php endif; ?>
</main>

<footer class="bg-dark text-white text-center py-4 mt-5">
    <small>FootData Pro 2026 | TFG ASIR - Infraestructura Google Cloud | Desarrollado para análisis de datos de fútbol y LALIGA</small>
</footer>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeBtn = document.getElementById('themeToggleBtn');
        themeBtn.addEventListener('click', () => {
            const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
            const nextTheme = isDark ? 'light' : 'dark';
            document.documentElement.setAttribute('data-bs-theme', nextTheme);
            localStorage.setItem('theme', nextTheme);
        });
        
        if ($('#miPlantilla').length) { 
            $('#miPlantilla').DataTable({ 
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" }, 
                "pageLength": 10, "order": [[5, "desc"]] 
            }); 
        }
        
        var popoverList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function (p) { return new bootstrap.Popover(p) });
    });
</script>
</body>
</html>