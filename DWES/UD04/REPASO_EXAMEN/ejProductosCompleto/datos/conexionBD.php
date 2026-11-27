<?php

class ConexionBD{
    
    public static function conectar(): PDO{
    require __DIR__ . "/../config/configuracion.php";

    // si el fichero todavía no existe, habrá que crear las tablas
    $bdNueva=!file_exists($ficheroSQLite);

    $conexion=new PDO('sqlite:' . $ficheroSQLite);
    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    if($bdNueva){
        $rutaSql=__DIR__ . "/../config/crearBD_sqlite.sql";
        $conexion->exec(file_get_contents($rutaSql));
    }

    return $conexion;

}
}

?>