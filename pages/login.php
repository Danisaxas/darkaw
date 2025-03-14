<?php
require_once '../db/config.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM User WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_username, $db_password);
        $stmt->fetch();

        // Verificar la contraseña
        if ($password === $db_password) {
            echo "<div class='alert success'>¡Bienvenido de nuevo, $db_username!</div>";
        } else {
            echo "<div class='alert error'>Contraseña incorrecta.</div>";
        }
    } else {
        echo "<div class='alert error'>Usuario no encontrado.</div>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Iniciar sesión</h2>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="submit-btn">
                    <button type="submit">Iniciar sesión</button>
                </div>
            </form>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate</a></p>
        </div>
    </div>
</body>
</html>
