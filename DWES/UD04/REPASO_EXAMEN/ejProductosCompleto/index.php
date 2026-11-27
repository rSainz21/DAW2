<?php
require_once __DIR__ . "/config/factoriaAplicacion.php";
require_once __DIR__ . "/entidades/Producto.php";

$factoria=new FactoriaAplicacion();
$service=$factoria->crearProductoService();

//insert
if(isset($_POST['insertar'])){

    $producto=new Producto(0, $_POST['nombre'], (float) $_POST['precio']);
    $servicio->insertarProducto($producto);

    header('Location: index.php');
    exit();
}

//actualizar
if(isset($_POST['actualizar'])){

    $producto=new Producto((int) $_POST['id'], $_POST['nombre'], (float) $_POST['precio']);
    $servicio->actualizarProducto($producto);

    header('Location: index.php');
    exit();
}

//borrar
if(isset($_POST['borrar'])){

    $servicio->borrarProducto((int) $_POST['id']);

    header('Location: index.php');
    exit();
}

//reemplazar
if(isset($_POST['transaccion'])){

    try{

        $servicio->reemplazarProducto('Raton', 'Super raton', 105);

    }catch(Throwable $e){
        //el rollback lo hace el servicio
    }

    header('Location: index.php');
    exit();
}

//read obtener
$productos=$servicio->obtenerProductos();

require_once __DIR__ . "/presentacion/vista.php";

?>