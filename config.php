<?php
$servername = "yamanote.proxy.rlwy.net";
$username = "root";
$password = "kaPbicIPDwvZAyMWXMfBeuFUMQxZMyrv";
$dbname = "railway";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
