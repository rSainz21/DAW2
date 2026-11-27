<?php
require_once __DIR__ . "/../entidades/Libro.php";

interface LibroDAO{

    public function obtenerTodos():array;

    public function insertar(Libro $libro):void;

    public function actualizar(Libro $libro):void;

    public function borrar($id):void;

    public function reemplazar($tituloAntiguo, $tituloNuevo, $precio):void;
}

?>