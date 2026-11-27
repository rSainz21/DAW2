<?php
require_once __DIR__ . "/vehiculoDAO.php";
require_once __DIR__ . "/conexionBD.php";

class VehiculoPDODAO implements VehiculoDAO{

    private PDO $conexion;

    public function __construct(PDO $conexion){
        $this->conexion=$conexion;
    }

    public function obtenerTodos():array{
        
        $filas=$this->conexion->query(
            "SELECT * FROM vehiculos"
        );

        $vehiculos=[];

        foreach($filas as $fila){
            $vehiculos[]=new Vehiculo(
                (int)$fila['id'],
                $fila['nombre'],
                (float)$fila['precio']
            );
        }
        return $vehiculos;
    }

    public function insertar(Vehiculo $vehiculo):void{

        $consulta=$this->conexion->prepare(
            "INSERT INTO vehiculos (nombre, precio)
            VALUES (?, ?)"
        );
        $consulta->execute([
            $vehiculo->nombre,
            $vehiculo->precio
        ]);
    }

    public function actualizar(Vehiculo $vehiculo):void{

        $consulta=$this->conexion->prepare(
            "UPDATE vehiculos SET nombre=?, precio=?
            WHERE id=?"
        );
        $consulta->execute([
            $vehiculo->nombre,
            $vehiculo->precio,
            $vehiculo->id
        ]);
    }

    public function borrar(int $id):void{

        $consulta=$this->conexion->prepare(
            "DELETE FROM vehiculos WHERE id=?"
        );
        $consulta->execute([$id]);
    }

    public function reemplazar($antiguo, $nuevo, $precio):void{

        $this->conexion->beginTransaction();

        try{
            //borrar antiguo
            $borrado=$this->conexion->prepare(
                "DELETE FROM vehiculos WHERE nombre=?"
            );
            $borrado->execute([$antiguo]);

            if($borrado->rowCount()===0){
                throw new Exception('No existe ese vehiculo');
            }
            //insertar el nuevo
            $insertado=$this->conexion->prepare(
                "INSERT INTO vehiculos (nombre, precio)
                VALUES (?, ?)"
            );
            $insertado->execute([$nuevo, $precio]);
            //si todo sale bien se hace un commit
            $this->conexion->commit();

        }catch(Throwable $e){

            if($this->conexion->inTransaction()){
                $this->conexion->rollBack();
            }
            throw $e;
        }
    }
}

?>