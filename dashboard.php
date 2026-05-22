<?php
session_start();

require_once 'conexion.php';


$stmt = $pdo->query("SELECT * FROM proyectos");
$proyectos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Panel de Administración</title>
</head>
<body class="bg-light">

    <div class="bg-dark text-white text-center py-2 fw-bold small fixed-top" style="z-index: 1040;">
        <i class="fa-solid fa-user-gear me-1"></i> PANEL ADMINISTRATIVO ACTIVO | 
        <a href="index.php" class="text-warning ms-2 me-3 text-decoration-none"><i class="fa-solid fa-eye"></i> Ver Sitio Público</a>
        <a href="logout.php" class="text-danger text-decoration-none"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
    </div>

    <nav class="main-bar navbar navbar-expand-lg navbar-dark fixed-top py-3" style="margin-top: 38px;">
        <div class="container-fluid px-3 px-md-5">
            <span class="navbar-brand name-portfolio">Panel Nylarion</span>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="header-links navbar-nav mx-auto text-center">
                    <li class="nav-item"><a class="nav-link" href="#adm-biografia">Gestionar Biografía</a></li>
                    <li class="nav-item"><a class="nav-link" href="#adm-herramientas">Gestionar Herramientas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#adm-proyectos">Gestionar Proyectos</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="adm-biografia" class="container mt-5 pt-3 px-4">
        <h1 class="title-part">Gestionar Biografía</h1>
    </div>

    <div class="general-container container my-3 border rounded-3 p-4 bg-white shadow-sm">
        <form action="acciones/guardar_biografia.php" method="POST" enctype="multipart/form-data">
            <p class="text-secondary small mb-4">
                <i class="fa-solid fa-user-pen me-1"></i> Actualiza tus datos de presentación y tu foto de perfil pública:
            </p>
            
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="nombre_perfil" class="form-label fw-bold small">Nombre en el Portafolio</label>
                        <input type="text" class="form-control" id="nombre_perfil" name="nombre_perfil" value="Luis (Nylarion)" required placeholder="Ej: Luis Silva">
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="foto_perfil" class="form-label fw-bold small">Foto de Perfil (Avatar)</label>
                        <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/*">
                        <div class="form-text xsmall text-muted">Deja este campo vacío si no deseas cambiar tu foto actual.</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label for="texto_biografia" class="form-label fw-bold small">Descripción Profesional</label>
                        <textarea class="form-control" id="texto_biografia" name="texto_biografia" rows="4" required placeholder="Escribe aquí tu presentación...">Hola, soy Luis, desarrollador web en formación. Me apasiona construir aplicaciones limpias, eficientes y seguras utilizando tecnologías modernas como Bootstrap y PHP.</textarea>
                    </div>
                </div>
            </div>
            
            <div class="text-end border-top pt-3 mt-2">
                <button type="submit" class="btn btn-warning btn-sm fw-bold px-4 shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios en Biografía
                </button>
            </div>
        </form>
    </div>

    <div style="margin-top: 140px;"></div>
        <div id="adm-herramientas" class="container mt-5 pt-3 px-4">
        <h1 class="title-part">Gestionar Herramientas</h1>
    </div>

    <div class="general-container container my-3 border rounded-3 p-4 bg-white shadow-sm">
        <form action="acciones/guardar_herramientas.php" method="POST" class="text-center">
            <p class="text-secondary small mb-4">
                <i class="fa-solid fa-square-check me-1"></i> Selecciona las casillas de las herramientas que deseas que aparezcan visibles en tu portafolio público:
            </p>
            
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="vscode" checked>
                    <span><i class="fa-solid fa-code"></i> VS Code</span>
                </label>
                
                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="python" checked>
                    <span><i class="fa-brands fa-python"></i> Python</span>
                </label>

                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="html" checked>
                    <span><i class="fa-brands fa-html5"></i> HTML</span>
                </label>

                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="css" checked>
                    <span><i class="fa-brands fa-css3-alt"></i> CSS</span>
                </label>

                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="js" checked>
                    <span><i class="fa-brands fa-js"></i> JavaScript</span>
                </label>

                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="git" checked>
                    <span><i class="fa-brands fa-git-alt"></i> Git</span>
                </label>

                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="linux" checked>
                    <span><i class="fa-brands fa-linux"></i> Linux</span>
                </label>

                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="php">
                    <span><i class="fa-brands fa-php"></i> PHP</span>
                </label>

                <label class="tool-checkbox">
                    <input type="checkbox" name="herramientas[]" value="mysql">
                    <span><i class="fa-solid fa-database"></i> MySQL</span>
                </label>
            </div>
            
            <div class="border-top pt-3 text-end">
                <button type="submit" class="btn btn-warning btn-sm fw-bold px-4 shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios en Herramientas
                </button>
            </div>
        </form>
    </div>

    <div id="adm-habilidades" class="container mt-5 pt-3 px-4 d-flex justify-content-between align-items-center">
        <h1 class="title-part">Gestionar Habilidades</h1>
        <button class="btn btn-dark btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarHabilidad">
            <i class="fa-solid fa-plus me-1"></i> Añadir Nueva Habilidad
        </button>
    </div>

    <div class="general-container container my-3 border rounded-3 p-4 bg-white shadow-sm">
        <form action="acciones/guardar_habilidades.php" method="POST">
            <p class="text-secondary small mb-4">
                <i class="fa-solid fa-sliders me-1"></i> Ajusta el porcentaje de dominio de tus habilidades técnicas existentes:
            </p>
            
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6">
                    <div class="p-3 border rounded bg-light position-relative">
                        <a href="acciones/eliminar_habilidad.php?id=1" class="text-danger position-absolute top-0 end-0 m-2 px-1" title="Eliminar Habilidad" onclick="return confirm('¿Eliminar esta habilidad?');">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                        
                        <label for="range-front" class="form-label fw-bold small d-flex justify-content-between pe-3">
                            <span>Frontend (HTML/CSS/JS)</span>
                            <span class="text-primary" id="val-front">85%</span>
                        </label>
                        <input type="range" class="form-range" min="0" max="100" id="range-front" name="hab[1]" value="85" oninput="document.getElementById('val-front').innerText = this.value + '%'">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="p-3 border rounded bg-light position-relative">
                        <a href="acciones/eliminar_habilidad.php?id=2" class="text-danger position-absolute top-0 end-0 m-2 px-1" title="Eliminar Habilidad" onclick="return confirm('¿Eliminar esta habilidad?');">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                        
                        <label for="range-back" class="form-label fw-bold small d-flex justify-content-between pe-3">
                            <span>Backend (PHP/MySQL)</span>
                            <span class="text-primary" id="val-back">70%</span>
                        </label>
                        <input type="range" class="form-range" min="0" max="100" id="range-back" name="hab[2]" value="70" oninput="document.getElementById('val-back').innerText = this.value + '%'">
                    </div>
                </div>
            </div>

            <div class="text-end border-top pt-3">
                <button type="submit" class="btn btn-warning btn-sm fw-bold px-4 shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios en Porcentajes
                </button>
            </div>
        </form>
    </div>


    <div id="adm-proyectos" class="container mt-5 pt-3 px-4 d-flex justify-content-between align-items-center">
        <h1 class="title-part">Gestionar Proyectos</h1>
        <button class="btn btn-dark btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarProyecto">
            <i class="fa-solid fa-plus me-1"></i> Agregar Nuevo Proyecto
        </button>
    </div>

    <div class="container my-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            
            <?php foreach ($proyectos as $proy): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm custom-card position-relative">
                        
                        <a href="acciones/eliminar_proyecto.php?id=<?= $proy['id'] ?>" 
                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 shadow"
                        onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto? Esta acción no se puede deshacer.');">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>

                        <img src="assets/img/<?= htmlspecialchars($proy['imagen']) ?>" class="card-img-top card-image-placeholder" alt="Miniatura">
                        
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($proy['titulo']) ?></h5>
                            <p class="card-text text-muted small"><?= htmlspecialchars($proy['descripcion']) ?></p>
                            <div class="d-flex gap-2 mt-3">
                                <span class="badge bg-secondary w-100 py-2">Enlace Demo: <?= $proy['url_demo'] != '#' ? 'Activo' : 'Ninguno' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>


    <div class="modal fade" id="modalAgregarHabilidad" tabindex="-1" aria-labelledby="modalHabilidadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="modalHabilidadLabel"><i class="fa-solid fa-circle-plus me-2"></i>Nueva Habilidad</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-toggle="modal" aria-label="Close"></button>
                </div>
                <form action="acciones/crear_habilidad.php" method="POST">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="nombre_habilidad" class="form-label fw-bold small">Nombre de la Tecnología / Habilidad</label>
                            <input type="text" class="form-control" id="nombre_habilidad" name="nombre_habilidad" required placeholder="Ej: Python, Java, Git, etc.">
                        </div>
                        <div class="mb-3">
                            <label for="porcentaje_inicial" class="form-label fw-bold small d-flex justify-content-between">
                                <span>Dominio o Porcentaje Inicial</span>
                                <span class="text-primary fw-bold" id="val-nueva">50%</span>
                            </label>
                            <input type="range" class="form-range" min="0" max="100" id="porcentaje_inicial" name="porcentaje_inicial" value="50" oninput="document.getElementById('val-nueva').innerText = this.value + '%'">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark btn-sm px-4">Registrar Habilidad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>