<?php

class ConexionBD{

    public static function conectar():PDO{
        require __DIR__ . "/../config/configuracion.php";

        if($motorBD==='SQLITE'){

            $bdNueva=!file_exists($ficheroSQLite)||filesize($ficheroSQLite)===0;

            $conexion=new PDO('sqlite:' . $ficheroSQLite);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($bdNueva){
                $conexion->exec(
                    file_get_contents(__DIR__ . "/../config/crearBD_sqlite.sql")
                );
            }
        }else{

            $conexion=new PDO(
                'mysql:hosts=' . $host . 
                ';dbname=' . $database . 
                ';charset=utf8mb4',$usuario, $contrasena
            );
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        return $conexion;
    }


    public static function probar():string{

        try{
            ConexionBD::conectar();
            return 'Base de datos conectada';
        
        }catch(PDOException $e){
            
            return 'La conexion ha fallado';
        }
    }
    //para usar la prueba hay que quitar  del index el require de la vista 
}

?>