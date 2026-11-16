<?php
include 'conexion.php';
require 'vendor/autoload.php'; // Librería phpseclib

use phpseclib3\Net\SSH2;

// --- Recibimos datos del formulario ---
$usuario = $_POST['usuario'];
$ip = $_POST['ip'];
$comando = $_POST['comando'];

// --- Buscamos la contraseña asociada en la BD ---
$stmt = mysqli_prepare($conn, "SELECT contrasena FROM usuarios WHERE usuario = ?");
mysqli_stmt_bind_param($stmt, 's', $usuario);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $contrasena);

if (!mysqli_stmt_fetch($stmt)) {
    exit(" No se encontró el usuario en la base de datos.");
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

// --- Conectamos por SSH ---
$ssh = new SSH2($ip);
if (!$ssh->login($usuario, $contrasena)) {
    exit(" Error: no se pudo iniciar sesión SSH con $usuario@$ip");
}

// --- Ejecutamos el comando ---
$output = $ssh->exec($comando);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Resultado SSH</title></head>
<body>
  <h2>Resultado del comando en <?php echo htmlspecialchars($ip); ?></h2>
  <pre><?php echo htmlspecialchars($output); ?></pre>
  <a href="ssh_form.php">Volver</a>
</body>
</html>
