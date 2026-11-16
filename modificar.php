<?php
// Archivo: modificar.php
// Modifica la contraseña de un usuario existente

include 'conexion.php';

$id = $_POST['id_credencial'];
$contrasena = $_POST['contrasena'];

$sql = "UPDATE credenciales SET contrasena = '$contrasena' WHERE id_credencial = $id";


if (mysqli_query($conn, $sql)) {
    echo " Contraseña actualizada correctamente.<br>";
} else {
    echo " Error: " . mysqli_error($conn);
}

mysqli_close($conn);
echo "<a href='index.html'>Volver</a>";
?>

