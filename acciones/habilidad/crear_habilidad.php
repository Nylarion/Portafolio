<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre_habilidad']);
    $porcentaje = (int)$_POST['porcentaje_inicial'];

    if (!empty($nombre)) {
        $sql = "INSERT INTO habilidades (nombre, porcentaje) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$nombre, $porcentaje])) {
            header('Location: ../../dashboard.php');
            exit;
        }
    }
    echo "Error al registrar la habilidad.";
}
?>