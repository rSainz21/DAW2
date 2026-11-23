<?php
// conexion.php → Infraestructura: crea la conexión PDO ($conexion)
require_once __DIR__ . "/configuracion.php";

try {
    $dsn = "mysql:host=$host;dbname=$baseDatos;charset=utf8mb4";
    $conexion = new PDO($dsn, $usuario, $contrasena, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false   // sentencias preparadas reales
    ]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die('Error de conexión');
}
?>
