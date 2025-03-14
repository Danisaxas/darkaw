<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="login.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" value="Iniciar sesión">
    </form>

    <p>¿No tienes una cuenta? <a href="register.php">Registrate aquí</a></p>
</body>
</html>
