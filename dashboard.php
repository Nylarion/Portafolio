<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: login.php');
    exit;
}

require_once 'config/conexion.php';

$stmtPerfil = $pdo->query("SELECT * FROM perfil WHERE id = 1");
$perfil = $stmtPerfil->fetch();

$stmtHerramientas = $pdo->query("SELECT * FROM herramientas");
$herramientas = $stmtHerramientas->fetchAll();

$stmtHabilidades = $pdo->query("SELECT * FROM habilidades ORDER BY id ASC");
$habilidades = $stmtHabilidades->fetchAll();

$stmtProyectos = $pdo->query("SELECT * FROM proyectos ORDER BY id DESC");
$proyectos = $stmtProyectos->fetchAll();

$stmtContactos = $pdo->query("SELECT * FROM contactos ORDER BY id DESC");
$contactos = $stmtContactos->fetchAll();
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
    <title>Panel de Administración</title>
</head>
<body class="bg-light">

    <nav class="main-bar navbar navbar-expand-lg navbar-dark fixed-top py-3">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex align-items-center flex-grow-1 overflow-hidden me-2">
                <div class="circle-icon flex-shrink-0">
                    &lt;/&gt;
                </div>
                <a class="name-portfolio navbar-brand ms-3 text-truncate" href="#">Nylarion | Panel De Administración</a>
            </div>
            
            <button class="navbar-toggler flex-shrink-0" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mynavbar">
                <div class="d-flex gap-2 ms-auto central-buttons mt-2 mt-lg-0">
                    <button class="main-btn btn" type="button" onclick="window.location.href='index.php'">Ver Sitio Público</button>
                    <button class="main-btn btn" type="button" onclick="window.location.href='acciones/logout.php'">Cerrar Sesión</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-wrapper d-flex">
        
        <aside class="sidebar-panel flex-shrink-0">
            <ul class="sidebar-links nav flex-column text-start px-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#adm-biografia"><i class="fa-solid fa-user-pen me-2"></i>Biografía</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#adm-herramientas"><i class="fa-solid fa-square-check me-2"></i>Herramientas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#adm-habilidades"><i class="fa-solid fa-sliders me-2"></i>Habilidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#adm-proyectos"><i class="fa-solid fa-folder-open me-2"></i>Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#adm-contactos"><i class="fa-solid fa-user me-2"></i>Contacto</a>
                </li>
            </ul>
        </aside>

        <main class="content-panel flex-grow-1 bg-light">
            
            <section id="adm-biografia" class="dashboard-section active">
                <div class="container-fluid pt-4 px-4">
                    <h1 class="title-part">Gestionar Biografía</h1>
                    <div class="general-container border rounded-3 p-4 bg-white shadow-sm my-3">
                        <form action="acciones/biografia/guardar_biografia.php" method="POST" enctype="multipart/form-data" class="js-confirm-form" data-mensaje="¿Seguro que quieres realizar esta acción y actualizar tu biografía?">
                            <p class="text-secondary small mb-4">
                                <i class="fa-solid fa-user-pen me-1"></i> Datos que aparecerán de forma pública:
                            </p>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nombre_perfil" class="form-label fw-bold small">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_perfil" name="nombre_perfil" value="<?= htmlspecialchars($perfil['nombre'] ?? '') ?>" required placeholder="Ej: Luis Silva">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="foto_perfil" class="form-label fw-bold small">Foto de Perfil</label>
                                        <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/*">
                                        <div class="form-text xsmall text-muted">Deja este campo vacío si no deseas cambiar tu foto actual.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="texto_biografia" class="form-label fw-bold small">Descripción Personal</label>
                                        <textarea class="form-control" id="texto_biografia" name="texto_biografia" rows="4" required placeholder="Escribe aquí tu presentación..."><?= htmlspecialchars($perfil['biografia'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end pt-3 mt-2">
                                <button type="submit" class="btn btn-dark btn-sm fw-bold px-4 shadow-sm">
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios en Biografía
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section id="adm-herramientas" class="dashboard-section">
                <div class="container-fluid pt-4 px-4">
                    <h1 class="title-part">Gestionar Herramientas</h1>
                    <div class="general-container border rounded-3 p-4 bg-white shadow-sm my-3">
                        <form action="acciones/herramienta/guardar_herramientas.php" method="POST" class="text-center js-confirm-form" data-mensaje="¿Seguro que quieres guardar los cambios en las herramientas visibles?">
                            <p class="text-secondary small mb-5">
                                <i class="fa-solid fa-square-check me-1"></i> Selecciona las casillas de las herramientas que deseas que aparezcan visibles en tu portafolio público:
                            </p>
                            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
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
                                ?>
                                <?php foreach ($herramientas as $herram): ?>
                                    <?php 
                                        $slug = $herram['slug'];
                                        $iconoClass = $iconos[$slug] ?? 'fa-solid fa-screwdriver-wrench';
                                        $isChecked = ($herram['visible'] == 1) ? 'checked' : '';
                                    ?>
                                    <label class="tool-checkbox">
                                        <input type="checkbox" name="herramientas[]" value="<?= htmlspecialchars($slug) ?>" <?= $isChecked ?>>
                                        <span><i class="<?= $iconoClass ?>"></i> <?= htmlspecialchars($herram['nombre']) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <div class="pt-3 text-end">
                                <button type="submit" class="btn btn-dark btn-sm fw-bold px-4 shadow-sm">
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios en Herramientas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section id="adm-habilidades" class="dashboard-section">
                <div class="container-fluid pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="title-part">Gestionar Habilidades</h1>
                        <button class="btn btn-dark btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarHabilidad">
                            <i class="fa-solid fa-plus me-1"></i> Añadir Nueva Habilidad
                        </button>
                    </div>
                    <div class="general-container border rounded-3 p-4 bg-white shadow-sm my-3">
                        <form action="acciones/habilidad/guardar_habilidades.php" method="POST" class="js-confirm-form" data-mensaje="¿Seguro que quieres guardar los cambios en los porcentajes de tus habilidades?">
                            <p class="text-secondary small mb-4">
                                <i class="fa-solid fa-sliders me-1"></i> Ajusta el porcentaje de dominio de tus habilidades técnicas existentes:
                            </p>
                            <div class="row g-4 mb-4">
                                <?php if (empty($habilidades)): ?>
                                    <div class="col-12 text-center text-muted py-3">No hay habilidades registradas.</div>
                                <?php else: ?>
                                    <?php foreach ($habilidades as $hab): ?>
                                        <div class="col-12 col-md-6">
                                            <div class="p-3 border rounded bg-light position-relative">
                                                <button type="button" class="btn btn-sm text-danger position-absolute top-0 end-0 m-2 px-1 js-delete-btn" 
                                                        data-url="acciones/habilidad/eliminar_habilidad.php?id=<?= $hab['id'] ?>" 
                                                        data-mensaje="¿Seguro que quieres realizar esta acción? La habilidad se eliminará permanentemente."
                                                        title="Eliminar Habilidad">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                                <label for="range-<?= $hab['id'] ?>" class="form-label fw-bold small d-flex justify-content-between pe-3">
                                                    <span><?= htmlspecialchars($hab['nombre']) ?></span>
                                                    <span class="text-dark" id="val-<?= $hab['id'] ?>"><?= $hab['porcentaje'] ?>%</span>
                                                </label>
                                                <input type="range" class="form-range" min="0" max="100" id="range-<?= $hab['id'] ?>" name="hab[<?= $hab['id'] ?>]" value="<?= $hab['porcentaje'] ?>" oninput="document.getElementById('val-<?= $hab['id'] ?>').innerText = this.value + '%'">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="text-end pt-3">
                                <button type="submit" class="btn btn-dark btn-sm fw-bold px-4 shadow-sm" <?= empty($habilidades) ? 'disabled' : '' ?>>
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios en Porcentajes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section id="adm-proyectos" class="dashboard-section">
                <div class="container-fluid pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="title-part">Gestionar Proyectos</h1>
                        <button class="btn btn-dark btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarProyecto">
                            <i class="fa-solid fa-plus me-1"></i> Agregar Nuevo Proyecto
                        </button>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 my-2">
                        <?php foreach ($proyectos as $proy): ?>
                            <div class="col">
                                <div class="card h-100 shadow-sm custom-card position-relative">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 shadow js-delete-btn"
                                            data-url="acciones/proyecto/eliminar_proyecto.php?id=<?= $proy['id'] ?>"
                                            data-mensaje="¿Seguro que quieres realizar esta acción? El proyecto se eliminará permanentemente.">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    <?php 
                                        $imgUrl = (!empty($proy['imagen'])) ? 'assets/img/' . htmlspecialchars($proy['imagen']) : 'assets/img/GitHub-Logo-700x394.png';
                                    ?>
                                    <img src="<?= $imgUrl ?>" class="card-img-top card-image-placeholder" alt="Miniatura" style="object-fit: scale-down;">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?= htmlspecialchars($proy['titulo']) ?></h5>
                                        <p class="card-text text-muted small"><?= htmlspecialchars($proy['descripcion']) ?></p>
                                        <div class="d-flex gap-2 mt-3">
                                            <span class="badge bg-secondary w-100 py-2">Enlace GitHub: <?= $proy['url_github'] != '#' ? 'Activo' : 'Ninguno' ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section id="adm-contactos" class="dashboard-section">
                <div class="container-fluid pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="title-part">Gestionar Contactos</h1>
                    </div>
                    <div class="general-container border rounded-3 p-4 bg-white shadow-sm my-3">
                        <form>
                            <p class="text-secondary small mb-4">
                                <i class="fa-solid fa-user me-2"></i> Revisa los mensajes que te han llegado:
                            </p>
                            <div class="row g-4 mb-4">
                                <?php if (empty($contactos)): ?>
                                    <div class="col-12 text-center text-muted py-3">No hay mensajes disponibles.</div>
                                <?php else: ?>
                                    <?php foreach ($contactos as $cont): ?>
                                        <div class="p-3 p-sm-5 border rounded bg-light position-relative h-100">
                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 shadow js-delete-btn"
                                                    data-url="acciones/contacto/eliminar_mensaje.php?id=<?= $cont['id'] ?>"
                                                    data-mensaje="¿Seguro que quieres realizar esta acción? El mensaje se eliminará permanentemente.">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>

                                            <div class="row g-0 align-items-center pe-4 pt-2">
                                                <div class="col-auto">
                                                    <div class="border rounded p-2 me-3" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; background-color: black;">
                                                        <img src="assets/img/user_default.png" class="img-fluid" alt="imagen-contacto" style="max-height: 100%; object-fit: scale-down;">
                                                    </div>
                                                </div>
                                                
                                                <div class="col flex-grow-1">
                                                    <h5 class="mb-1 small fw-bold">Nombre: <span class="fw-normal text-secondary text-break"><?= htmlspecialchars($cont['nombre']) ?></span></h5>
                                                    <p class="mb-1 small fw-bold">Correo: <span class="fw-normal text-secondary text-break"><?= htmlspecialchars($cont['correo']) ?></span></p>
                                                    <p class="mb-1 small fw-bold">Asunto: <span class="fw-normal text-secondary text-break"><?= htmlspecialchars($cont['asunto']) ?></span></p>
                                                    <p class="mb-0 small fw-bold">Mensaje: <span class="fw-normal text-secondary text-break"><?= htmlspecialchars($cont['mensaje']) ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <div class="modal fade" id="modalConfirmacionGlobal" tabindex="-1" aria-labelledby="modalConfirmLabel" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white py-2">
                    <h6 class="modal-title fw-bold" id="modalConfirmLabel">
                        <i class="fa-solid fa-circle-question text-light me-2"></i>Confirmación
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 text-center">
                    <p class="mb-0 small fw-medium" id="textoMensajeConfirmacion">¿Seguro que quieres realizar esta acción?</p>
                </div>
                <div class="modal-footer bg-light py-2 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light btn-sm border px-3" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-dark btn-sm fw-bold px-3" id="btnAceptarConfirmacion">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAgregarHabilidad" tabindex="-1" aria-labelledby="modalHabilidadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="modalHabilidadLabel"><i class="fa-solid fa-circle-plus me-2"></i>Nueva Habilidad</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="acciones/habilidad/crear_habilidad.php" method="POST">
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
                        <button type="button" class="btn btn-light btn-sm border px-3" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark btn-sm px-4">Registrar Habilidad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAgregarProyecto" tabindex="-1" aria-labelledby="modalProyectoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="modalProyectoLabel"><i class="fa-solid fa-folder-plus me-2"></i>Nuevo Proyecto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="acciones/proyecto/crear_proyecto.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="titulo_proyecto" class="form-label fw-bold small">Título del Proyecto</label>
                            <input type="text" class="form-control" id="titulo_proyecto" name="titulo" required placeholder="Ej: Sistema de Inventario">
                        </div>
                        <div class="mb-3">
                            <label for="desc_proyecto" class="form-label fw-bold small">Descripción</label>
                            <textarea class="form-control" id="desc_proyecto" name="descripcion" rows="3" required placeholder="Describe brevemente de qué trata..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="url_github" class="form-label fw-bold small">Enlace de GitHub (Opcional)</label>
                            <input type="text" class="form-control" id="url_github" name="url_github" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="img_proyecto" class="form-label fw-bold small">Imagen / Logo del Proyecto</label>
                            <input type="file" class="form-control" id="img_proyecto" name="imagen" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm border px-3" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark btn-sm px-4">Subir Proyecto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/scripts/script.js"></script>
</body>
</html>
