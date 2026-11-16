<?php
// Archivo: conexion.php
// Este archivo crea la conexión con la base de datos MySQL

$host = "localhost";
$user = "maru_bigatti";
$pass = "Frezza2020_@";
$db = "db_maru_bigatti_Parcial";

$conn = mysqli_connect($host, $user, $pass, $db);
//mostrar error si falla la conexion
if (!$conn) {
    die("No se pudo conectar: " . mysqli_connect_error());
}
?>