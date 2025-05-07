<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$puntuacion = $_POST['puntuacion'];
$fecha_estreno = $_POST['fecha_estreno'];
$recaudacion = $_POST['recaudacion'];
$categoria = $_POST['categoria'];
$idioma = $_POST['idioma'];

// Insertar o encontrar categoría
$stmt = $conn->prepare("INSERT INTO categoria (nombre) VALUES (?) ON DUPLICATE KEY UPDATE nombre=nombre");
$stmt->bind_param("s", $categoria);
$stmt->execute();
$categoria_id = $conn->insert_id ?: $conn->query("SELECT id_categoria FROM categoria WHERE nombre='$categoria'")->fetch_assoc()['id_categoria'];

// Insertar o encontrar idioma
$stmt = $conn->prepare("INSERT INTO idioma (nombre) VALUES (?) ON DUPLICATE KEY UPDATE nombre=nombre");
$stmt->bind_param("s", $idioma);
$stmt->execute();
$idioma_id = $conn->insert_id ?: $conn->query("SELECT id_idioma FROM idioma WHERE nombre='$idioma'")->fetch_assoc()['id_idioma'];

// Insertar película
$stmt = $conn->prepare("INSERT INTO pelicula (nombre, puntuacion, fecha_estreno, recaudacion, id_categoria, id_idioma)
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sdsdii", $nombre, $puntuacion, $fecha_estreno, $recaudacion, $categoria_id, $idioma_id);
$stmt->execute();

header("Location: mostrar.php");
?>
