<?php
$conexion = new PDO("sqlite:" . __DIR__ . "/libros.db");

$resultado = $conexion->query("SELECT id, titulo, precio FROM libros");

while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    echo $fila["id"] . " | " . $fila["titulo"] . " | " . $fila["precio"] . PHP_EOL;
}
