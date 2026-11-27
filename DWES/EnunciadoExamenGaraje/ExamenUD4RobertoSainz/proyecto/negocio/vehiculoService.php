<?php
require_once __DIR__ . "/../datos/vehiculoDAO.php";
require_once __DIR__ . "/../entidades/Vehiculo.php";
require_once __DIR__ . "/../datos/vehiculoPDODAO.php";


class VehiculoService{

    private VehiculoPDODAO $dao;

    public function __construct(VehiculoPDODAO $dao){
        $this->dao=$dao;
    }

    public function obtenerVehiculos():array{
        
        return $this->dao->obtenerTodos();
    }

    public function insertar(Vehiculo $vehiculo):void{

        $this->dao->insertar($vehiculo);
    }

    public function actualizar(Vehiculo $vehiculo):void{

        $this->dao->actualizar($vehiculo);
    }

    public function borrar(int $id):void{

        $this->dao->borrar($id);
    }

    public function reeemplazar(string $antiguo, string $nuevo,float $precio):void{

        $this->dao->reemplazar($antiguo, $nuevo, $precio);
    }

}



?>