<?php
// inventario.php → Capa de lógica.
//
// Este archivo muestra de forma SECUENCIAL qué operaciones se ejecutan.
// Cada llamada a persistencia se hace explícitamente y su resultado se guarda
// en una variable independiente. No se utiliza un array de operaciones.
//
// Al terminar, $materiales y $auditoria contienen los datos actualizados
// que necesita la capa de presentación.

// ------------------------------------------------------------
// 1) CREATE: insertar un material nuevo (INSERT)
// ------------------------------------------------------------
$idNuevo = insertarMaterial(
    'Pipetas Pasteur',
    150,
    'unidades',
    'Estantería B3'
);

// ------------------------------------------------------------
// 2) READ: consultar el material recién insertado (SELECT)
// ------------------------------------------------------------
$materialInsertado = false;

if ($idNuevo !== false) {
    $materialInsertado = obtenerMaterialPorId($idNuevo);
}

// ------------------------------------------------------------
// 3) UPDATE: registrar una salida válida de stock.
//    La función también inserta el registro de auditoría.
//    Ambas operaciones se realizan en una única transacción.
// ------------------------------------------------------------
$salidaCorrecta = registrarSalidaStock(1, 2);

// ------------------------------------------------------------
// 4) UPDATE: intentar una salida imposible para provocar un error.
//    El stock no debe modificarse y la transacción debe hacer ROLLBACK.
// ------------------------------------------------------------
$salidaIncorrecta = registrarSalidaStock(2, 9999);

// ------------------------------------------------------------
// 5) DELETE: eliminar el material con ID 4 (DELETE)
// ------------------------------------------------------------
$bajaCorrecta = eliminarMaterial(4);

// ------------------------------------------------------------
// 6) READ: recuperar el estado final de la base de datos.
//    Estos datos son los que utilizará la vista.
// ------------------------------------------------------------
$materiales = obtenerMateriales();
$auditoria = obtenerAuditoria(10);
?>
