<?php
require_once __DIR__ . "/../entidades/Vehiculo.php";

interface VehiculoDAO{

    public function obtenerTodos():array;

    public function insertar(Vehiculo $vehiculo):void;

    public function actualizar(Vehiculo $vehiculo):void;

    public function borrar(int $id):void;

    public function reemplazar($antiguo, $nuevo, $precio):void;
}

?>