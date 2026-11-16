<?php
// Archivo: alta.php
// Da de alta (agrega) un usuario nuevo

include 'conexion.php';

// Obtenemos los datos enviados desde el formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$switch_id = $_POST['switch_id'];




// Insertamos en la tabla (contraseña en texto plano)
$sql = "INSERT INTO usuarios (usuario, contraseña) VALUES ('$usuario', '$contraseña')";

if ($conn->query($sql) === TRUE) {
    echo " Usuario agregado correctamente.<br>";
} else {
    echo " Error: " .  $conn->error;

$conn->close();
echo "<a href='index.html'>Volver</a>";
?>
