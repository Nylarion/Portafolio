<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png">
    <title>Acceso Administrador</title>
</head>
<body class="d-flex align-items-center justify-content-center flex-column" style="height: 100vh; background-color: var(--bg-dark);">
    
    <div class="contact-container p-4" style="width: 380px;">
        <h3 class="text-center mb-4 fw-bold text-dark title-part" style="margin: 10px 0 25px 0; font-size: 1.5rem;">Panel Administrador</h3>
        
        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="mb-3 p-3 text-center" style="background-color: #000000; color: #ffffff; border: 2px solid #333333; border-radius: 8px; font-size: 13px; animation: hypr-window-open 0.3s var(--hypr-bezier);">
                <i class="fa-solid fa-triangle-exclamation text-white me-2"></i>
                <span class="fw-bold">[ERROR]:</span> Credenciales incorrectas.
            </div>
        <?php endif; ?>

        <form action="autenticar.php" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold text-dark"><i class="fa-solid fa-user me-2"></i>Usuario</label>
                <input type="text" name="username" class="form-control form-dark-input" placeholder="root" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-dark"><i class="fa-solid fa-lock me-2"></i>Contraseña</label>
                <input type="password" name="password" class="form-control form-dark-input" placeholder="••••••••" required>
            </div>
            
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-hypr-submit py-2">
                    <i class="fa-solid fa-key me-2"></i>Ingresar
                </button>
                
                <a href="../index.php" class="tools-button text-center mt-2" style="text-decoration: none; font-size: 14px; padding: 8px;">
                    <i class="fa-solid fa-arrow-left me-2"></i>Volver al Inicio
                </a>
            </div>
        </form>
    </div>

</body>
</html>
