<?php
require_once '../db/config.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];  // La contraseña en texto claro
    $full_name = $_POST['full_name'];

    $stmt = $conn->prepare("SELECT id FROM User WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<div class='alert error'>El nombre de usuario o correo ya está en uso.</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO User (email, username, password, full_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $username, $password, $full_name);

        if ($stmt->execute()) {
            echo "<div class='alert success'>¡Registro exitoso!</div>";
        } else {
            echo "<div class='alert error'>Error al registrar al usuario: " . $stmt->error . "</div>";
        }
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
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Registrarse</h2>
            <form action="register.php" method="POST">
                <div class="input-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-group">
                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="input-group">
                    <label for="full_name">Nombre Completo:</label>
                    <input type="text" name="full_name" id="full_name" required>
                </div>
                <div class="submit-btn">
                    <button type="submit">Registrar</button>
                </div>
            </form>
            <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
        </div>
    </div>
</body>
</html>
