<?php

class ConexionBD{

    public static function conectar():PDO{
        require __DIR__ . "/../config/configuracion.php";

        if($motorBaseDatos==='SQLITE'){
            $dbNueva=!file_exists($ficheroSQLite)||filesize($ficheroSQLite===0);
            $conexion=new PDO('sqlite:' . $ficheroSQLite);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($dbNueva){
                $conexion->exec(file_get_contents(__DIR__ . "/../config/crearSQLite.sql"));
            }
        }else{

        }
        return $conexion;
    }

    public static function probar():string{
        try{
            ConexionBD::conectar();
            return 'Conectado';
        }catch(PDOException $e){
            return 'Fallido';
        }
    }
}


?>