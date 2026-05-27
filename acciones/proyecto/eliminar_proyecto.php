<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../../config/conexion.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];


    
    $sql = "DELETE FROM proyectos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$id])) {
        header('Location: ../../dashboard.php');
    } else {
        echo "Error al eliminar el proyecto.";
    }
} else {
    header('Location: ../../dashboard.php');
}
?>