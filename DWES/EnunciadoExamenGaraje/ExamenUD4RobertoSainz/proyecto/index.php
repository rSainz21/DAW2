<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');


//PRUEBA DE LA CONEXION A BASE DE DATOS SQLITE y MYSQL
//echo ConexionBD::probar();
// ------------------------------------ TODO: require/s necesario/s
require_once __DIR__ . "/datos/conexionBD.php";
require_once __DIR__ . "/negocio/vehiculoService.php";
require_once __DIR__ . "/entidades/Vehiculo.php";
require_once __DIR__ . "/datos/vehiculoDAO.php";

// ------------------------------------ TODO: crear el service
$conexion=ConexionBD::conectar();
$dao=new VehiculoPDODAO($conexion);
$service=new VehiculoService($dao);

/*****************
 * INSERT
 *****************/
if (isset($_POST["insertar"])) {

    $vehiculo = new Vehiculo(
        0,
        $_POST["nombre"],
        (float) $_POST["precio"]
    );

    // ------------------------------- TODO: Alta de vehículo
    $service->insertar($vehiculo);

    header("Location: index.php");
    exit();
}

/*****************
 * UPDATE
 *****************/
if (isset($_POST["actualizar"])) {

    $vehiculo = new Vehiculo(
        (int) $_POST["id"],
        $_POST["nombre"],
        (float) $_POST["precio"]
    );

    // ---------------------------- TODO: Actualización de vehículo
    $service->actualizar($vehiculo);


    header("Location: index.php");
    exit();
}

/*****************
 * DELETE
 *****************/
if (isset($_POST["borrar"])) {

    // ------------------------------------ TODO: Borrado de vehículo
    $service->borrar((int) $_POST['id']);


    header("Location: index.php");
    exit();
}

/*****************
 * TRANSACCION (reemplazar vehículo: borrar + insertar)
 *
 * Los datos están fijados en el código (hardcodeados):
 *   sustituye el vehículo "Moto" por "Moto Tuneada" (25 k$).
 *
 * PRECONDICIÓN antes de pulsar el botón:
 *   debe existir en la base de datos un vehículo cuyo nombre sea
 *   exactamente "Moto".
 *
 * Si NO se cumple (por ejemplo, porque ya se ejecutó una vez y el
 * vehículo "Moto" ya no existe), la capa de datos lanza una
 * excepción, hace ROLLBACK (no se modifica nada) y aquí se captura
 * para que la página no se rompa: se recarga la lista sin cambios.
 *****************/
if (isset($_POST["transaccion"])) {

    try {

        // ------------------------------------ TODO: invocar transacción con valores hardcodeados
        $service->reeemplazar('Moto','Moto Tuneada', 25);


    } catch (Throwable $e) {

        // Precondición no cumplida o fallo en la transacción:
        // ya se ha hecho rollback, no hay nada más que deshacer.
    }

    header("Location: index.php");
    exit();
}

/*****************
 * READ
 *****************/
// ---------------------------------- TODO:Obtener vehículos
$vehiculos=$service->obtenerVehiculos();

// ---------------------------------- TODO: require de la vista
require_once __DIR__ . "/presentacion/vista.php";