<?php
include 'conexion.php';

// Carga los usuarios y dispositivos disponibles para construir los selectores.
$sql = 'SELECT id_credenciales, usuario FROM credenciales ORDER BY usuario';
$result = mysqli_query($conn, $sql);

$sqlSwitch = 'SELECT nombre, ip FROM `switch` ORDER BY nombre';
$resultSwitch = mysqli_query($conn, $sqlSwitch);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Conexión SSH con usuarios de la BD</title>
</head>
<body>
<h2> Conectar a un dispositivo SSH</h2>

<form action="conexion_ssh.php" method="POST">
  <label for="usuario">Seleccione un usuario:</label>
  <select name="usuario" id="usuario" required>
    <option value="">-- Elegir usuario --</option>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <option value="<?php echo htmlspecialchars($row['usuario'], ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($row['usuario'], ENT_QUOTES, 'UTF-8'); ?>
      </option>
    <?php endwhile; ?>
  </select><br><br>

  <label for="dispositivo">Seleccione un dispositivo:</label>
  <select name="dispositivo" id="dispositivo">
    <option value="">-- Elegir dispositivo --</option>
    <?php while ($switch = mysqli_fetch_assoc($resultSwitch)): ?>
      <option value="<?php echo htmlspecialchars($switch['nombre'], ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($switch['nombre'] . ' (' . $switch['ip'] . ')', ENT_QUOTES, 'UTF-8'); ?>
      </option>
    <?php endwhile; ?>
  </select><br><br>

  <label>IP del dispositivo:</label>
  <input type="text" name="ip" placeholder="192.168.2.30"><br><br>

  <label>Comando a ejecutar:</label>
  <input type="text" name="comando" value="show running-config" required><br><br>

  <input type="submit" value="Conectar y ejecutar">
</form>

</body>
</html>
<?php
mysqli_free_result($result);
mysqli_free_result($resultSwitch);
mysqli_close($conn);
?>