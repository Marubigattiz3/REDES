<?php
// modificar.php
include 'conexion.php';

echo "<h3>Resultado modificación:</h3>";
//verifica si llegó la ip del formulario
if(isset($_POST['ip'])) {
    $ip = $_POST['ip']; //ip dle switch que se va a modificar
    $nombre = $_POST['nombre']; //su nuevo nombre
    $modelo = $_POST['modelo']; //nuevo modelo
    $ubicacion = $_POST['ubicacion']; //nueva ubicación
    
    echo "Intentando modificar switch con IP: $ip<br>";
    
    //comando sql para modificar los datos - actualizarlos
    $sql = "UPDATE Switch SET ";
    $campos = array();
    //solo agrega campos que no esten vacíos 
    if(!empty($nombre)) $campos[] = "Nombre = '$nombre'";
    if(!empty($modelo)) $campos[] = "Modelo = '$modelo'";
    if(!empty($ubicacion)) $campos[] = "Ubicacion = '$ubicacion'";
    //une todos los campos con una " , " ya que sino estarán mal en la base de datos
    if(count($campos) > 0) {
        $sql .= implode(", ", $campos) . " WHERE IP = '$ip'";
        //ejecuta el comando sql y muestra si se modificó o no y qué se modifico
                if (mysqli_query($conn, $sql)) {
            if(mysqli_affected_rows($conn) > 0) {
                echo " SWITCH MODIFICADO<br>";
                echo "IP: $ip<br>";
                if(!empty($nombre)) echo "Nuevo nombre: $nombre<br>";
                if(!empty($modelo)) echo "Nuevo modelo: $modelo<br>";
                if(!empty($ubicacion)) echo "Nueva ubicación: $ubicacion<br>";
            } else {
                echo " No se encontró switch con IP: $ip o no hubo cambios<br>";
            }
        } else {
            echo " FALLÓ: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo " No se especificaron campos para modificar<br>";
    }
} else {
    echo " No se recibió IP para modificar<br>";
}

mysqli_close($conn);
echo "<br><a href='index.html'>Volver</a>";
?>