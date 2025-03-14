<?php
include('config.php');

// Crear la tabla User si no existe
$tableCheckQuery = "SHOW TABLES LIKE 'User'";
$result = $conn->query($tableCheckQuery);

if ($result->num_rows == 0) {
    // La tabla no existe, crearla
    $createTableQuery = "
        CREATE TABLE User (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL UNIQUE,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            full_name VARCHAR(255) NOT NULL
        );
    ";

    if ($conn->query($createTableQuery) === TRUE) {
        echo "Tabla 'User' creada exitosamente.<br>";
    } else {
        echo "Error al crear la tabla: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];

    // Validación del nombre de usuario (solo letras y números, mínimo 6 caracteres)
    if (!preg_match("/^[a-zA-Z0-9]{6,}$/", $username)) {
        echo "El nombre de usuario debe tener más de 6 caracteres y solo puede contener letras y números.";
    } else {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Verificar si el nombre de usuario o el correo ya están registrados
        $checkQuery = "SELECT * FROM User WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "El correo o el nombre de usuario ya están registrados.";
        } else {
            // Insertar los datos en la base de datos
            $insertQuery = "INSERT INTO User (email, username, password, full_name) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param('ssss', $email, $username, $hashed_password, $full_name);

            if ($stmt->execute()) {
                echo "Registro exitoso. Puedes iniciar sesión.";
            } else {
                echo "Error al registrar. Intenta nuevamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registrarse</h2>
    <form action="register.php" method="POST">
        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="full_name">Nombre Completo:</label>
        <input type="text" name="full_name" id="full_name" required><br><br>

        <input type="submit" value="Registrarse">
    </form>

    <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
</body>
</html>
