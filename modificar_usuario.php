<?php
include 'conexion.php';

$id = $_POST['id_credencial'];
$contrasena = $_POST['contrasena'];

// Actualiza solo la contraseña de la credencial cuyo ID fue enviado.
$stmt = mysqli_prepare($conn, 'UPDATE credenciales SET password = ? WHERE id_credenciales = ?');
mysqli_stmt_bind_param($stmt, 'si', $contrasena, $id);
mysqli_stmt_execute($stmt);

echo 'Usuario modificado correctamente.<br>';
mysqli_close($conn);
echo "<br><a href='index.html'>Volver</a>";
?>
