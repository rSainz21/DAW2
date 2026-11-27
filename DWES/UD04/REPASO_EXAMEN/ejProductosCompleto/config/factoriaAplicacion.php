<?php
require_once __DIR__ . "/configuracion.php";
require_once __DIR__ . "/../datos/conexionBD.php";
require_once __DIR__ . "/../datos/productoPDODAO.php";
require_once __DIR__ . "/../negocio/productoServicio.php";

class FactoriaAplicacion{

    public function crearProductoService():ProductoService{
        $conexion=ConexionBD::conectar();
        $dao=new ProductoPDODAO($conexion);
        return new ProductoService($dao);
    }
}

?>