<?php

require_once __DIR__ . "/entidades/Producto.php";
require_once __DIR__ . "/negocio/productoService.php";

$service=new ProductoService();

//Insert
if(isset($_POST['insertar'])){
    $producto=new Producto(
        0,
        $_POST['nombre'],
        (float) $_POST['precio']
    );

    $service->altaProducto($producto);

    header('Location: index.php');
    exit();
}

//update
if(isset($_POST['actualizar'])){
    $producto=new Producto(
        (int) $_POST['id'],
        $_POST['nombre'],
        (float) $_POST['precio']
    );

    $service->actualizarProducto($producto);

    header('Location: index.php');
    exit();
}

//delete
if(isset($_POST['borrar'])){

    $service->borrarProducto((int) $_POST['id']);

    header('Location: index.php');
    exit();
}

//transaccion (reemplazar->borrar y eliminar)
if(isset($_POST['transaccion'])){

    try{
        $service->reemplazarProducto("Raton", "Raton Gaming", 25);
    }catch(Throwable $e){
        //el rollback ya lo hace el servicio
    }

    header('Location: index.php');
    exit();
}

//read
$productos=$service->obtenerProductos();
require __DIR__ . "/presentacion/vista.php";
?>