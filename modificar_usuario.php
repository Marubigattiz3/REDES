<?php
include 'conexion.php';

echo "<h3>Resultado modificar usuario:</h3>";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $contrasena = $_POST['contrasena'];
 
    echo "Intentando modificar usuario con ID: $id<br>";
 
    $sql = "UPDATE Usuario SET Contraseña = '$contrasena' WHERE ID = '$id'";
 
    if (mysqli_query($conn, $sql)) {
        if(mysqli_affected_rows($conn) > 0) {
            echo " USUARIO MODIFICADO<br>";
            echo "ID: $id<br>";
            echo "Nueva contraseña: $contrasena<br>";
        } else {
            echo " No se encontró usuario con ID: $id<br>";
        }
    } else {
        echo " FALLÓ: " . mysqli_error($conn) . "<br>";
    }
} else {
        echo " No se recibió ID para modificar<br>";
}

mysqli_close($conn);
echo "<br><a href='index.html'>Volver</a>";
?>
