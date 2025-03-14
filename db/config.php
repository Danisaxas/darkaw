<?php
$host = 'yamanote.proxy.rlwy.net';
$username = 'root';
$password = 'kaPbicIPDwvZAyMWXMfBeuFUMQxZMyrv';
$dbname = 'railway';
$port = '13695';

// Crear la conexión
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear la tabla User si no existe
$query = "
CREATE TABLE IF NOT EXISTS User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Ejecutar la consulta para crear la tabla
if ($conn->query($query) === TRUE) {
    // Tabla creada o ya existe
    // No hacer nada
} else {
    // Si hubo un error al crear la tabla, mostrar un mensaje
    echo "Error al crear la tabla: " . $conn->error;
}
?>
