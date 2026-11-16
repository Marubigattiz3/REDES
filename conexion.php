<?php
// Parámetros compartidos de conexión con la base de datos del proyecto.
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_maru_bigatti_parcial';

$conn = mysqli_connect($host, $user, $pass, $db);
// Mantiene correctamente los caracteres acentuados al intercambiar datos con MySQL.
mysqli_set_charset($conn, 'utf8mb4');
?>