<?php
require_once __DIR__ . "/productoDAO.php";

class ProductoPDODAO implements ProductoDAO{
    private PDO $conexion;
    public function __construct(PDO $conexion){
        $this->conexion=$conexion;
    }

    public function obtenerTodos():array{
        $consulta=$this->conexion->query("SELECT * FROM productos");
        $filas=$consulta->fetchAll(PDO::FETCH_ASSOC);
        $productos=[];

        foreach($filas as $fila){

            $productos[]=new Producto(
                $fila['id'],
                $fila['nombre'],
                $fila['precio']
            );
        }
        return $productos;
    }

    public function obtenerPorId(int $id): ?Producto{
        $consulta=$this->conexion->prepare(
            "SELECT * FROM productos WHERE id=?"
        );
        $consulta->execute([$id]);

        $fila=$consulta->fetch(PDO::FETCH_ASSOC);

        if($fila===false){
            return null;
        }

        return new Producto(
            $fila['id'],
            $fila['nombre'],
            $fila['precio']
        );
    }

    public function insertar(Producto $producto):void{
        $consulta=$this->conexion->prepare(
            "INSERT INTO productos (nombre,precio)
            VALUES (?,?)"
        );
        $consulta->execute([$producto->nombre,$producto->precio]);
    }

    public function actualizar(Producto $producto):void{
        $consulta=$this->conexion->prepare(
            "UPDATE productos SET nombre=?,precio=?
            WHERE id=?"
        );
        $consulta->execute([$producto->nombre,$producto->precio,$producto->id]);
    }

    public function borrar(int $id):void{
        $consulta=$this->conexion->prepare(
            "DELETE FROM productos WHERE id=?"
        );
        $consulta->execute([$id]);
    }

    public function reemplazarProducto(string $antiguo, string $nuevo, float $precio):void{
        $this->conexion->beginTransaction();

        try{
            $borrado=$this->conexion->prepare(
                "DELETE FROM productos WHERE nombre=?"
            );
            $borrado->execute([$antiguo]);

            if($borrado->rowCount()===0){
                throw new RuntimeException("Ese producto no existe");
            }

            $insertado=$this->conexion->prepare(
                "INSERT INTO productos (nombre,precio)
                VALUES (?,?)"
            );
            $insertado->execute([$nuevo,$precio]);

            $nuevo->id = (int) $this->conexion->lastInsertId();

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