<?php
include 'conexion.php';

echo "<h3>Resultado eliminar usuario:</h3>";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
 
    echo "Intentando eliminar usuario con ID: $id<br>";
 
    $sql = "DELETE FROM Usuario WHERE ID = '$id'";
 
    if (mysqli_query($conn, $sql)) {
        if(mysqli_affected_rows($conn) > 0) {
            echo " USUARIO ELIMINADO<br>";
            echo "ID: $id<br>";
        } else {
            echo " No se encontró usuario con ID: $id<br>";
        }
    } else {
        echo " FALLÓ: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo " No se recibió ID para eliminar<br>";
}    

mysqli_close($conn);
echo "<br><a href='index.html'>Volver</a>";
?>
