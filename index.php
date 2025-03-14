<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once 'db/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="welcome-box">
            <h1>Bienvenido a nuestra plataforma</h1>
            <p>Explora, regístrate e inicia sesión para acceder a todos los servicios.</p>
            <div class="buttons">
                <a href="pages/register.php" class="btn">Registrarse</a>
                <a href="pages/login.php" class="btn">Iniciar sesión</a>
            </div>
        </div>
    </div>
</body>
</html>
