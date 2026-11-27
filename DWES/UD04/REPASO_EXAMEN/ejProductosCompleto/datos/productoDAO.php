<?php
require_once __DIR__ . "/../entidades/Producto.php";

interface ProductoDAO{

    public function obtenerTodos(): array;
    public function obtenerPorId(int $id): ?Producto;
    public function insertar(Producto $producto):void;
    public function actualizar(Producto $producto):void;
    public function borrar(int $id):void;
    public function reemplazarProducto(
        string $nombreAntiguo,
        string $nombreNuevo,
        float $precio):void;
}


?>