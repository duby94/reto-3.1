<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost:3307", "root", "", "mvc"); // Ajusta la contraseña si tu root la tiene

// Comprobar si hay error de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "¡Conexión exitosa a la base de datos!";
?>
