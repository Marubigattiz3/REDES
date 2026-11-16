<?php
include 'conexion.php';

echo "<h3>Resultado agregar usuario:</h3>";

if(isset($_POST['ip_switch'])) {
    $ip_switch = $_POST['ip_switch'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
 
    echo "Intentando agregar usuario: $usuario al switch $ip_switch<br>";
 
    $sql = "INSERT INTO Usuario (IP_Switch, Usuario, Contraseña) VALUES ('$ip_switch', '$usuario', '$contrasena')";
 
    if (mysqli_query($conn, $sql)) {
        echo " USUARIO AGREGADO<br>";
        echo "Usuario: $usuario<br>";
        echo "Switch: $ip_switch<br>";
    } else {
        echo " FALLÓ: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo " No se recibieron datos<br>";
} 

mysqli_close($conn);
echo "<br><a href='index.html'>Volver</a>";
?>