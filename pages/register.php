<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once '../db/config.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];  // La contraseña en texto claro
    $full_name = $_POST['full_name'];

    // Verificar si el nombre de usuario o correo ya existe en la base de datos
    $stmt = $conn->prepare("SELECT id FROM User WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Si el usuario o correo ya existe, mostrar un mensaje
        echo "El nombre de usuario o correo ya está en uso.";
    } else {
        // Insertar el nuevo usuario con la contraseña en texto claro
        $stmt = $conn->prepare("INSERT INTO User (email, username, password, full_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $username, $password, $full_name);
        
        if ($stmt->execute()) {
            // Si la inserción es exitosa, mostrar un mensaje
            echo "Registro exitoso.";
        } else {
            // Si hubo un error, mostrar el mensaje de error
            echo "Error al registrar al usuario: " . $stmt->error;
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
        <h2>Registrarse</h2>
        <form action="register.php" method="POST">
            <div>
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="username">Nombre de Usuario:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <label for="full_name">Nombre Completo:</label>
                <input type="text" name="full_name" id="full_name" required>
            </div>
            <div>
                <button type="submit">Registrar</button>
            </div>
        </form>
        <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
    </div>
</body>
</html>
