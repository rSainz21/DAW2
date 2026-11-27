<?php

//$motorBD="SQLITE";
$motorBD='MYSQL';
/* Para utilizar mysql hay que ejecutar el script de creacion manualmente
 en workbench, que no he conseguido automatizarlo, sqlite funciona perfectamente */

$ficheroSQLite=__DIR__ . "/../vehiculos.db";

//credenciales para mysql
$host='localhost';
$database='garaje';
$usuario='root';
$contrasena='r00tMy$ql';

?>