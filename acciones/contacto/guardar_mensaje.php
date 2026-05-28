<?php

$host     = 'localhost';
$dbName   = 'lcerda_db1';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $nombre  = trim($_POST['nombre']);
    $correo   = trim($_POST['correo']);
    $asunto  = trim($_POST['asunto']);
    $mensaje = trim($_POST['mensaje']);


    if (!empty($nombre) && !empty($correo) && !empty($asunto) && !empty($mensaje)) {
        

        $sql = "INSERT INTO contactos (nombre, correo, asunto, mensaje) VALUES (:nombre, :correo, :asunto, :mensaje)";
        $stmt = $pdo->prepare($sql);


        try {
            $stmt->execute([
                ':nombre'  => $nombre,
                ':correo'   => $correo,
                ':asunto'  => $asunto,
                ':mensaje' => $mensaje
            ]);


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
