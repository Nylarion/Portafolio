<?php
// 1. Configuración de la conexión a la base de datos
$host     = 'localhost';
$dbName   = 'lcerda_db1'; // Reemplaza con el nombre de tu BD
$username = 'lcerda';       // Reemplaza con tu usuario de BD
$password = 'Nhtq.6458';    // Reemplaza con tu contraseña de BD

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// 2. Verificar que los datos vengan por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recolectar y limpiar levemente los datos del formulario
    $nombre  = trim($_POST['nombre']);
    $correo   = trim($_POST['correo']);
    $asunto  = trim($_POST['asunto']);
    $mensaje = trim($_POST['mensaje']);

    // Validar que no estén vacíos
    if (!empty($nombre) && !empty($correo) && !empty($asunto) && !empty($mensaje)) {
        
        // Preparar la consulta SQL (PreparedStatement para mayor seguridad)
        $sql = "INSERT INTO contactos (nombre, correo, asunto, mensaje) VALUES (:nombre, :correo, :asunto, :mensaje)";
        $stmt = $pdo->prepare($sql);

        // Ejecutar pasando los datos reales
        try {
            $stmt->execute([
                ':nombre'  => $nombre,
                ':correo'   => $correo,
                ':asunto'  => $asunto,
                ':mensaje' => $mensaje
            ]);

            // Redireccionar al usuario o mostrar mensaje de éxito
            echo "<script>
                    alert('¡Mensaje enviado y guardado con éxito!');
                    window.location.href = '../../index.php';
                  </script>";
        } catch (PDOException $e) {
            echo "Error al guardar el mensaje: " . $e->getmessage();
        }

    } else {
        echo "Por favor, completa todos los campos del formulario.";
    }
} else {
    echo "Acceso no permitido.";
}
?>