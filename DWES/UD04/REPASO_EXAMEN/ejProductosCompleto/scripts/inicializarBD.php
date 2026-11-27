<?php

require_once __DIR__ . "/../datos/conexionBD.php";

$conexion=ConexionBD::conectar();
$rutaSql=__DIR__ . "/../config/crearBD_sqlite.sql";
$sqlCreacion=file_get_contents($rutaSql);
$conexion->exec($sqlCreacion);

echo "Base de datos creada";

?>