<?php
include 'conexion.php';
require 'vendor/autoload.php';

use phpseclib3\Net\SSH2;

$usuario = $_POST['usuario'] ?? '';
$ip = trim($_POST['ip'] ?? '');
$dispositivo = trim($_POST['dispositivo'] ?? '');
$comando = trim($_POST['comando'] ?? 'show running-config');

// Se requiere un usuario válido para recuperar sus credenciales y autenticar por SSH.
if ($usuario === '') {
    die('Debe seleccionar un usuario.');
}

if ($dispositivo !== '') {
    // Si se eligió un dispositivo guardado, se usa su IP registrada en la base de datos.
    $stmt = mysqli_prepare($conn, 'SELECT ip FROM `switch` WHERE nombre = ? OR ip = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 'ss', $dispositivo, $dispositivo);
    mysqli_stmt_execute($stmt);
    $ipSeleccionada = null;
    mysqli_stmt_bind_result($stmt, $ipSeleccionada);
    if (mysqli_stmt_fetch($stmt)) {
        $ip = $ipSeleccionada;
    }
    mysqli_stmt_close($stmt);
}

if ($ip === '') {
    die('Debe indicar una IP o seleccionar un dispositivo.');
}

// Recupera la contraseña asociada al usuario antes de cerrar la conexión a MySQL.
$stmt = mysqli_prepare($conn, 'SELECT password FROM credenciales WHERE usuario = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 's', $usuario);
mysqli_stmt_execute($stmt);
$contrasena = null;
mysqli_stmt_bind_result($stmt, $contrasena);
if (!mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    die('No se encontró el usuario en la base de datos.');
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

try {
    // La autenticación debe completarse antes de enviar el comando remoto.
    $ssh = new SSH2($ip);
    if (!$ssh->login($usuario, $contrasena)) {
        throw new RuntimeException('No se pudo autenticar por SSH en ' . $ip);
    }

    $output = $ssh->exec($comando);
} catch (Throwable $e) {
    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Error SSH</title></head><body>';
    echo '<h2>Error al conectar por SSH</h2>';
    echo '<p>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<a href="ssh_form.php">Volver</a>';
    echo '</body></html>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Resultado SSH</title></head>
<body>
  <h2>Resultado del comando en <?php echo htmlspecialchars($ip, ENT_QUOTES, 'UTF-8'); ?></h2>
  <!-- Se escapa la salida para mostrarla como texto y no como HTML. -->
  <pre><?php echo htmlspecialchars($output ?? '', ENT_QUOTES, 'UTF-8'); ?></pre>
  <a href="ssh_form.php">Volver</a>
</body>
</html>
