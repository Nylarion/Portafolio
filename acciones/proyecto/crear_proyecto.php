<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $url_demo = trim($_POST['url_demo']) ?: '#';
    $url_github = trim($_POST['url_github']) ?: '#';
    

    $nombre_imagen = '';


    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagen']['tmp_name'];
        $fileName = $_FILES['imagen']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {

            $nombre_imagen = time() . '_' . bin2hex(random_bytes(4)) . '.' . $fileExtension;
            

            $uploadFileDir = '../../assets/img/';
            
            if(!is_dir($uploadFileDir)){
                mkdir($uploadFileDir, 0755, true);
            }
            
            $dest_path = $uploadFileDir . $nombre_imagen;


            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                $nombre_imagen = 'default_project.png';
            }
        }
    }


    $sql = "INSERT INTO proyectos (titulo, descripcion, imagen, url_demo, url_github) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$titulo, $descripcion, $nombre_imagen, $url_demo, $url_github])) {
        header('Location: ../../dashboard.php');
    } else {
        echo "Error al guardar el proyecto en la base de datos.";
    }
}
?>