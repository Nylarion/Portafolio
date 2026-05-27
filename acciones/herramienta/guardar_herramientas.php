<?php
session_start();


if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../../config/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    


    $herramientasSeleccionadas = $_POST['herramientas'] ?? [];

    try {

        $pdo->beginTransaction();


        $pdo->query("UPDATE herramientas SET visible = 0");


        if (!empty($herramientasSeleccionadas)) {
            $stmt = $pdo->prepare("UPDATE herramientas SET visible = 1 WHERE slug = ?");
            
            foreach ($herramientasSeleccionadas as $slug) {
                $stmt->execute([$slug]);
            }
        }


        $pdo->commit();

    } catch (Exception $e) {

        $pdo->rollBack();
        die("Error al guardar las herramientas: " . $e->getMessage());
    }
}


header('Location: ../../dashboard.php');
exit;