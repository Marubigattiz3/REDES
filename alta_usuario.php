<?php
include 'conexion.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// La consulta preparada evita insertar los datos del formulario directamente en SQL.
$stmt = mysqli_prepare($conn, 'INSERT INTO credenciales (usuario, password, fecha) VALUES (?, ?, CURDATE())');
mysqli_stmt_bind_param($stmt, 'ss', $usuario, $contrasena);
mysqli_stmt_execute($stmt);

echo '<h3>Usuario agregado correctamente.</h3>';
mysqli_close($conn);
echo "<br><a href='index.html'>Volver</a>";
?>