?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conexion.php';

// Cargamos los usuarios de la tabla
$sql = "SELECT id, usuario FROM usuarios";
$result = mysqli_query($conn, $sql);
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
    <?php while($row = mysqli_fetch_assoc($result)): ?>
      <option value="<?php echo htmlspecialchars($row['usuario']); ?>">
        <?php echo htmlspecialchars($row['usuario']); ?>
              </option>
    <?php endwhile; ?>
  </select><br><br>

  <label>IP del dispositivo:</label>
  <input type="text" name="ip" placeholder="192.168.2.30" required><br><br>

  <label>Comando a ejecutar:</label>
  <input type="text" name="comando" value="show running-config" required><br><br>

  <input type="submit" value="Conectar y ejecutar">
</form>

</body>
</html>
<?php mysqli_close($conn); ?>