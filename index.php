<?php
require_once 'config/conexion.php';

$stmtPerfil = $pdo->query("SELECT * FROM perfil WHERE id = 1");
$perfil = $stmtPerfil->fetch();

$stmtHerramientas = $pdo->query("SELECT * FROM herramientas WHERE visible = 1");
$herramientas = $stmtHerramientas->fetchAll();

$stmtHabilidades = $pdo->query("SELECT * FROM habilidades ORDER BY id ASC");
$habilidades = $stmtHabilidades->fetchAll();

$stmtProyectos = $pdo->query("SELECT * FROM proyectos ORDER BY id DESC");
$proyectos = $stmtProyectos->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png">
    <title>Portafolio</title>
</head>
<body class="loader-active">

    <div id="hypr-loader">
        <div class="loader-terminal">
            <div class="terminal-header">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="terminal-title">systemd-boot // linux</span>
            </div>
            <div class="terminal-body">
                <p class="line"><span class="prompt">[ OK ]</span> Started Light Display Manager.</p>
                <p class="line"><span class="prompt">[ OK ]</span> Initializing Hyprland Session...</p>
                <p class="line loading-text"><i class="fa-solid fa-circle-notch fa-spin me-2"></i>Loading Nylarion's Environment</p>
                <div class="hypr-mini-bar">
                    <div class="hypr-mini-progress"></div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-bar navbar navbar-expand-lg navbar-dark fixed-top py-3">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex align-items-center">
                <div class="circle-icon">
                    &lt;/&gt;
                </div>
                <a class="name-portfolio navbar-brand ms-3" href="#">Nylarion</a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="header-links navbar-nav mx-auto text-center my-3 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#biografia">Biografía</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#herramientas">Herramientas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tecnologias">Tecnologías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#proyectos">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                </ul>

                <div class="d-flex justify-content-center">
                    <button class="main-btn btn w-100 w-lg-auto" type="button" onclick="window.location.href='acciones/login.php'">
                        <i class="fa-solid fa-terminal me-2"></i>Iniciar Sesión
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mt-5 pt-5 px-4">
        
        <h1 id="biografia" class="title-part">Biografía</h1>
        <div class="general-container container p-4 my-3">
            <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-4">
                <?php 
                    if (!empty($perfil['foto'])) {
                        $fotoPerfil = 'assets/img/' . htmlspecialchars($perfil['foto']);
                    } else {
                        $fotoPerfil = 'assets/img/user_default.png'; 
                    }
                ?>
                <img class="user-image img-fluid rounded-circle mb-3 mb-sm-0" src="<?= $fotoPerfil ?>" alt="Foto de Perfil">    
                <div class="text-center text-sm-start">
                    <h2 class="fw-bold mb-2 text-dark"><?= htmlspecialchars($perfil['nombre'] ?? 'Nylarion') ?></h2>
                    <p class="mb-0 text-muted-custom">
                        <?= nl2br(htmlspecialchars($perfil['biografia'] ?? '')) ?>
                    </p>
                </div>
            </div>
        </div>

        <h1 id="herramientas" class="title-part">Herramientas</h1>
        <div class="tools-container d-flex flex-wrap justify-content-center gap-3 pt-4">
            <?php 
            $iconos = [
                'vscode' => 'fa-solid fa-code',
                'python' => 'fa-brands fa-python',
                'html'   => 'fa-brands fa-html5',
                'css'    => 'fa-brands fa-css3-alt',
                'js'     => 'fa-brands fa-js',
                'git'    => 'fa-brands fa-git-alt',
                'linux'  => 'fa-brands fa-linux',
                'php'    => 'fa-brands fa-php',
                'mysql'  => 'fa-solid fa-database'
            ];

            if (empty($herramientas)): ?>
                <p class="text-muted small">No hay herramientas visibles seleccionadas.</p>
            <?php else: ?>
                <?php foreach ($herramientas as $herram): 
                    $slug = $herram['slug'];
                    $iconoClass = $iconos[$slug] ?? 'fa-solid fa-screwdriver-wrench';
                ?>
                    <button class="tools-button">
                        <i class="<?= $iconoClass ?> me-2"></i><?= htmlspecialchars($herram['nombre']) ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <h1 id="tecnologias" class="title-part">Tecnologías Dominadas</h1>
        <div class="general-container container my-3 py-5 px-4">
            <div class="row g-4 justify-content-center">
                <?php if (empty($habilidades)): ?>
                    <div class="col-12 text-center text-muted">No hay habilidades registradas aún.</div>
                <?php else: ?>
                    <?php foreach ($habilidades as $hab): ?>
                        <div class="col-12 col-md-6 mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-1 fw-bold small">
                                <span class="text-dark"><?= htmlspecialchars($hab['nombre']) ?></span>
                                <span class="text-dark"><?= (int)$hab['porcentaje'] ?>%</span>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar-custom" style="width: <?= (int)$hab['porcentaje'] ?>%;"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <h1 id="proyectos" class="title-part">Proyectos</h1>
        <div class="my-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                <?php if (empty($proyectos)): ?>
                    <div class="col-12 text-center text-muted py-4">Aún no se han añadido proyectos.</div>
                <?php else: ?>
                    <?php foreach ($proyectos as $index => $proy): ?>
                        <div class="col" style="--card-index: <?= $index; ?>;">
                            <div class="custom-card h-100 shadow-sm d-flex flex-column justify-content-between p-3">
                                <div>
                                    <?php 
                                        if (!empty($proy['imagen'])) {
                                            $imagenProyecto = 'assets/img/' . htmlspecialchars($proy['imagen']);
                                        } else {
                                            $imagenProyecto = 'assets/img/GitHub-Logo-700x394.png'; 
                                        }
                                    ?>
                                    <div class="card-image-placeholder d-flex align-items-center justify-content-center mb-3">
                                        <img src="<?= $imagenProyecto ?>" alt="<?= htmlspecialchars($proy['titulo']) ?>" class="img-fluid rounded">
                                    </div>
                                    <h5 class="card-title fw-bold text-dark mb-2"><?= htmlspecialchars($proy['titulo']) ?></h5>
                                    <p class="text-muted-custom small mb-4"><?= nl2br(htmlspecialchars($proy['descripcion'])) ?></p>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="<?= htmlspecialchars($proy['url_github']) ?>" target="_blank" class="custom-btn-github btn">
                                        <i class="fa-brands fa-github me-2"></i>Ver Proyecto
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <h1 id="contacto" class="title-part">Contacto</h1>
        <div class="row justify-content-center py-4">
            <div class="contact-container col-11 col-md-8 col-lg-6 p-4">
                <form action="acciones/contacto/guardar_mensaje.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold text-dark">Nombre</label>
                        <input type="text" class="form-control form-dark-input" id="nombre" placeholder="Tu nombre completo" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold text-dark">Correo Electrónico</label>
                        <input type="email" class="form-control form-dark-input" id="correo" placeholder="tucorreo@email.com" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="asunto" class="form-label fw-bold text-dark">Asunto</label>
                        <input type="text" class="form-control form-dark-input" id="asunto" placeholder="Asunto del mensaje" name="asunto" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label fw-bold text-dark">Mensaje</label>
                        <textarea class="form-control form-dark-input" rows="5" id="mensaje" name="mensaje" placeholder="Escribe tu mensaje aquí" required></textarea>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-hypr-submit btn-lg py-2">
                            <i class="far fa-paper-plane me-2"></i>Enviar Mensaje
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <footer class="main-footer py-4 mt-5">
        <div class="container-fluid px-3 px-md-5 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
            <span class="footer-name">Portafolio © <?= htmlspecialchars($perfil['nombre']) ?></span>
            <a href="https://github.com/nylarion" target="_blank" class="footer-github-link">
                <i class="fa-brands fa-github me-2"></i>GitHub
            </a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/scripts/script.js"></script>
</body>
</html>
