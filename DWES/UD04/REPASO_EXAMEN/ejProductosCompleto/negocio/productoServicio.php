<?php

require_once __DIR__ . "/../entidades/Producto.php";
require_once __DIR__ . "/../datos/conexionBD.php";

class productoServicio{
    private ProductoDAO $dao;

    public function __construct(ProductoDAO $dao){

        $this->dao=$dao;
    }

    public function obtenerProductos():array{
        
        return $this->dao->obtenerTodos();
    }

    public function insertarProducto(Producto $producto):void{

        if($producto->precio<0){
            throw new Exception("El precio no puede ser negativo");
        }

        $this->dao->insertar($producto);
    }

    public function actualizarProducto(Producto $producto):void{
        
        $this->dao->actualizar($producto);
    }

    public function borrarProducto(int $id):void{
        
        $this->dao->borrar($id);
    }

    public function reemplazarProducto(string $nombreAntiguo, string $nombreNuevo, float $precio):void{
        
        $nombreAntiguo=trim($nombreAntiguo);
        $nombreNuevo=trim($nombreNuevo);

        if($nombreAntiguo===''||$nombreNuevo===''){
            throw new Exception('Los nombres no pueden estar vacios');
        }

        if($precio<0){
            throw new Exception("El precio no puede ser negativo");
        }

        $this->dao->reemplazarProducto($nombreAntiguo,$nombreNuevo,$precio);
    }
}

?>