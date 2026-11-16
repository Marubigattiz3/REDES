<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$ip = $_POST['ip'];
$modelo = $_POST['modelo'];
$ubicacion = $_POST['ubicacion'];

// Guarda el switch usando parámetros para tratar los datos como valores, no como SQL.
$stmt = mysqli_prepare($conn, 'INSERT INTO `switch` (nombre, ip, modelo, `ubicación`) VALUES (?, ?, ?, ?)');
mysqli_stmt_bind_param($stmt, 'ssss', $nombre, $ip, $modelo, $ubicacion);
mysqli_stmt_execute($stmt);

echo 'Switch agregado correctamente.<br>';
echo 'Nombre: ' . $nombre . '<br>';
echo 'IP: ' . $ip . '<br>';

mysqli_close($conn);
echo " <br> <a href='index.html'> Volver al inicio </a>";
?>
