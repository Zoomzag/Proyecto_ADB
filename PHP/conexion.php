<?php
$host = "localhost";
$user = "root";       
$password = "";       
$dbname = "peliculas_db";

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
