<?php
// db/config.php

$host = 'yamanote.proxy.rlwy.net';
$port = 13695;
$dbname = 'railway';
$username = 'root';
$password = 'kaPbicIPDwvZAyMWXMfBeuFUMQxZMyrv';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    // Crear tabla users si no existe
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>