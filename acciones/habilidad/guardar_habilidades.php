<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hab'])) {
    $habilidades = $_POST['hab'];

    $stmt = $pdo->prepare("UPDATE habilidades SET porcentaje = ? WHERE id = ?");

    foreach ($habilidades as $id => $porcentaje) {
        $stmt->execute([(int)$porcentaje, (int)$id]);
    }

    header('Location: ../../dashboard.php');
    exit;
}
?>