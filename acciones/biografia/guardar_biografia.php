<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre_perfil']);
    $biografia = trim($_POST['texto_biografia']);


    $sql = "UPDATE perfil SET nombre = ?, biografia = ? WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $biografia]);


    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto_perfil']['tmp_name'];
        $fileName = $_FILES['foto_perfil']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $nombre_foto = 'avatar_' . time() . '.' . $fileExtension;
            $uploadFileDir = '../../assets/img/';
            
            if (move_uploaded_file($fileTmpPath, $uploadFileDir . $nombre_foto)) {

                $sqlFoto = "UPDATE perfil SET foto = ? WHERE id = 1";
                $stmtFoto = $pdo->prepare($sqlFoto);
                $stmtFoto->execute([$nombre_foto]);
            }
        }
    }

    header('Location: ../../dashboard.php');
    exit;
}
?>