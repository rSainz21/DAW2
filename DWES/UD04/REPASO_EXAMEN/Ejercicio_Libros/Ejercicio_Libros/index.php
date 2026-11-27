<?php
require_once __DIR__ . "/entidades/Libro.php";
require_once __DIR__ . "/negocio/libroServicio.php";

$servicio=new libroServicio();

//insertar
if(isset($_POST['insertar'])){
    $libro=new Libro(
        0,
        $_POST['titulo'],
        (float)$_POST['precio']
    );
    $servicio->altaLibro($libro);
    header('Location: index.php');
    exit();
}

//actualizar
if(isset($_POST['actualizar'])){
    $libro=new Libro(
        (int)$_POST['id'],
        $_POST['titulo'],
        (int)$_POST['precio']
    );
    $servicio->actualizarLibro($libro);
    header('Location: index.php');
    exit();
}

//borrar
if(isset($_POST['borrar'])){
    $servicio->borrarLibro((int)$_POST['id']);
    header('Location: index.php');
    exit();
}

//reemplazar
if(isset($_POST['transaccion'])){
    try{
        $servicio->reemplazarLibro('poesia', 'super poesia', 79);
    }catch(Throwable $e){
        
    }
    header('Location: index.php');
    exit();
}

//obtener
$libros=$servicio->obtenerLibros();
require_once __DIR__ . "/presentacion/vista.php";


?>