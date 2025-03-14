<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: pages/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Bienvenido</h1>
    <a href="pages/login.php">Iniciar sesión</a> | <a href="pages/register.php">Registrarse</a>
</body>
</html>
