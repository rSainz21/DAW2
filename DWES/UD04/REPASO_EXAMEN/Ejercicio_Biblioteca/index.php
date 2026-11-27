<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
require_once __DIR__ . "/datos/conexionBD.php";
require_once __DIR__ . "/negocio/libroServicio.php";
require_once __DIR__ . "/datos/LibroPDODAO.php";
require_once __DIR__ . "/entidades/Libro.php";

$conexion=ConexionBD::conectar();
$dao=new LibroDAOPDO($conexion);
$servicio=new LibroServicio($dao);

if(isset($_POST['insertar'])){
    
    $libro=new Libro( 0, $_POST['titulo'], (float) $_POST['precio']);
    $servicio->insertar($libro);
    header('Location: index.php');
    exit();
}

if(isset($_POST['actualizar'])){

    $libro=new Libro((int) $_POST['id'], $_POST['titulo'], (float) $_POST['precio']);
    $servicio->actualizar($libro);
    header('Location: index.php');
    exit();
}

if(isset($_POST['borrar'])){

    $servicio->borrar((int) $_POST['id']);
    header('Location: index.php');
    exit();
}

if(isset($_POST['transaccion'])){

    try{

        $servicio->reemplazar(
            "El Quijote",
            "El Quijote ilustrado",
            30
        );

    }catch(Throwable $e){

        //el servicio se encarga de lanzar la excepcion
    }
    header('Location: index.php');
    exit();
}

//read obtenewr todos

$libros=$servicio->obtenerLibros();

require_once __DIR__ . "/presentacion/vista.php";
?>