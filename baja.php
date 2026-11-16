<?php
// Archivo: baja.php
// Elimina un usuario por su nombre

include 'conexion.php';

$id = $_POST['id_credencial'];

$sql = "DELETE FROM usuarios WHERE id_credencial = '$id'";

if (mysqli_query($conn, $sql)) {
    echo "🗑️Usuario eliminado correctamente.<br>";
} else {
    echo " Error: " . mysqli_error($conn);
}

mysqli_close($conn);
echo "<a href='index.html'>Volver</a>";
?>