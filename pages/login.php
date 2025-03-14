<?php
session_start();
include('../db/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar si el usuario existe en la base de datos
    $query = "SELECT * FROM User WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña usando password_verify
        if (password_verify($password, $user['password'])) {
            // Guardar los datos del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            header('Location: ../index.php');
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El nombre de usuario no existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form action="login.php" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Iniciar sesión">
    </form>
    <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
</body>
</html>
