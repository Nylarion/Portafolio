<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../../config/conexion.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM habilidades WHERE id = ?");
    if ($stmt->execute([$id])) {
        header('Location: ../../dashboard.php');
        exit;
    } else {
        echo "Error al eliminar la habilidad.";
    }
} else {
    header('Location: ../../dashboard.php');
    exit;
}
?>