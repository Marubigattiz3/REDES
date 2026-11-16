<?php
include 'conexion.php';

$id = $_POST['id_credencial'];

// El ID se enlaza como entero para eliminar únicamente la credencial indicada.
$stmt = mysqli_prepare($conn, 'DELETE FROM credenciales WHERE id_credenciales = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

echo 'Usuario eliminado correctamente.<br>';
mysqli_close($conn);
echo "<a href='index.html'>Volver</a>";
?>