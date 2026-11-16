<?php
include 'conexion.php';

$ip = $_POST['ip'];
$nombre = $_POST['nombre'];
$modelo = $_POST['modelo'];
$ubicacion = $_POST['ubicacion'];

// La dirección IP identifica el switch que se actualizará.
$stmt = mysqli_prepare($conn, 'UPDATE `switch` SET nombre = ?, modelo = ?, `ubicación` = ? WHERE ip = ?');
mysqli_stmt_bind_param($stmt, 'ssss', $nombre, $modelo, $ubicacion, $ip);
mysqli_stmt_execute($stmt);

echo 'Switch modificado correctamente.<br>';
mysqli_close($conn);
echo "<br><a href='index.html'>Volver</a>";
?>