<?php
session_start();
require_once '../config/conexion.php';

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
$stmt->execute([$user]);
$usuario = $stmt->fetch();

if ($usuario && $pass === $usuario['password']) {
    $_SESSION['autenticado'] = true;
    $_SESSION['nombre'] = $usuario['nombre_completo'];
    header('Location: ../dashboard.php');
    exit();
} else {
    header('Location: login.php?error=1');
    exit();
}
?>
