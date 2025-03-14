<?php
session_start();

// Cerrar sesión
session_unset();
session_destroy();

header('Location: ../index.php');
exit();
?>
