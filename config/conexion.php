<?php

$host = "localhost";
$db   = "lcerda_db1"; 
$user = "lcerda";               
$pass = "Nhtq.6458";                  
$charset = "utf8mb4";


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      
    PDO::ATTR_EMULATE_PREPARES   => false,                 
];

try {

     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {

     die("Error crítico de conexión a la base de datos: " . $e->getMessage());
}
?>