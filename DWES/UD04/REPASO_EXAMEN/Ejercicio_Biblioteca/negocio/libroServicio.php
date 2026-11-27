<?php
require_once __DIR__ . "/../datos/LibroDAO.php";
require_once __DIR__ . "/../entidades/Libro.php";

class LibroServicio{

    private LibroDAO $dao;

    public function __construct(LibroDAO $dao){
        $this->dao=$dao;
    }

    public function obtenerLibros():array{

        return $this->dao->obtenerTodos();
    }

    public function insertar(Libro $libro):void{

        $this->dao->insertar($libro);
    }

    public function actualizar(Libro $libro):void{

        $this->dao->actualizar($libro);
    }

    public function borrar($id):void{

        $this->dao->borrar($id);
    }

    public function reemplazar(string $antiguo, string $nuevo, float $precio):void{
        $this->dao->reemplazar($antiguo, $nuevo, $precio);
    }
}




?>