<?php
include 'conexion.php';

echo "<h3> Resultado: </h3>";

if(isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $ip = $_POST['ip'];
    $modelo = $_POST['modelo'];
    $ubicacion = $_POST['ubicacion'];
 
    echo "Agregando: $nombre ($ip) <br>";
 
    // comando sql para agregar los datos a la DB
    $sql = "INSERT INTO Switch (Nombre, IP, Modelo, Ubicacion) VALUES ('$nombre', '$ip', '$modelo', '$ubicacion')";
 
    //ejecuta el comando
    if (mysqli_query($conn, $sql)) {
        echo " SWITCH AGREGADO CON ÉXITO <br>";
        echo "Nombre: $nombre <br>";
        echo "IP: $ip <br>";
    } else {
        echo " FALLÓ: " . mysqli_error($conn) . "<br>";
    }
} else {
        echo " No se recibieron datos <br>";
}
//cierra la conexion
mysqli_close($conn);
echo " <br> <a href='index.html'> Volver al inicio </a>";
?>
