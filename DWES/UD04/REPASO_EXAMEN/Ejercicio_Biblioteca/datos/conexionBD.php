<?php

class ConexionBD
{

    public static function conectar(): PDO
    {
        require __DIR__ . "/../config/configuracion.php";

        if ($motorBaseDatos === 'SQLITE') {

            // ¿La BD es nueva (no existe o está vacía)? Hay que mirarlo ANTES de
            // conectar, porque conectar crea el fichero si no existe.
            $bdNueva = !file_exists($ficheroSQLite) || filesize($ficheroSQLite) === 0;

            $conexion = new PDO("sqlite:" . $ficheroSQLite);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Si es nueva: crea la tabla y carga los libros iniciales
            if ($bdNueva) {
                $conexion->exec(
                    file_get_contents(__DIR__ . "/../config/crearBD_SQLite.sql")
                );
            }

        } else {

            $conexion = new PDO(
                "mysql:host=" . $host .
                ";dbname=" . $baseDatos .
                ";charset=utf8mb4",
                $user,
                $contrasena
            );

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $conexion;
    }

    public static function probarConexion(): string
    {

        try {

            ConexionBD::conectar();
            return 'Conexion exitosa';

        } catch (PDOException $e) {

            return "No se ha podido conectar con la base de datos";
        }
    }
}

?>