<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
    <h1>Bienvenido</h1>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hola, <?php echo $_SESSION['full_name']; ?>. <a href="pages/logout.php">Cerrar sesión</a></p>
    <?php else: ?>
        <p>No has iniciado sesión. <a href="pages/login.php">Inicia sesión</a> o <a href="pages/register.php">regístrate</a></p>
    <?php endif; ?>
</body>
</html>
