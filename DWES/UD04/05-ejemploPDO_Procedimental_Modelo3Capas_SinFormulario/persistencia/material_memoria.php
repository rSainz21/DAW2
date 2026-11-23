<?php
// material_memoria.php → Implementación en memoria (solo demos, sin transacción real)
$almacenMateriales = [
    1 => ['id' => 1, 'nombre' => 'Ácido clorhídrico 37%', 'stock' => 12,  'unidad' => 'litros',   'ubicacion' => 'Armario A1'],
    2 => ['id' => 2, 'nombre' => 'Guantes de nitrilo',    'stock' => 200, 'unidad' => 'unidades', 'ubicacion' => 'Estantería B2'],
    3 => ['id' => 3, 'nombre' => 'Tubos de ensayo',       'stock' => 80,  'unidad' => 'unidades', 'ubicacion' => 'Armario C3'],
    4 => ['id' => 4, 'nombre' => 'Etanol 96%',            'stock' => 25,  'unidad' => 'litros',   'ubicacion' => 'Armario A2'],
];
$siguienteIdMaterial = 5;
$auditoriaMemoria = [];

function obtenerMateriales(): array {
    global $almacenMateriales;
    $lista = array_values($almacenMateriales);
    usort($lista, fn($a, $b) => $a['nombre'] <=> $b['nombre']);
    return $lista;
}

function obtenerMaterialPorId(int $id): array|false {
    global $almacenMateriales;
    return $almacenMateriales[$id] ?? false;
}

function insertarMaterial(string $nombre, int $stock, string $unidad, string $ubicacion): int|false {
    global $almacenMateriales, $siguienteIdMaterial;
    $id = $siguienteIdMaterial++;
    $almacenMateriales[$id] = [
        'id' => $id, 'nombre' => $nombre, 'stock' => $stock,
        'unidad' => $unidad, 'ubicacion' => $ubicacion
    ];
    return $id;
}

function eliminarMaterial(int $id): bool {
    global $almacenMateriales;
    if (!isset($almacenMateriales[$id])) {
        return false;
    }
    unset($almacenMateriales[$id]);
    return true;
}

/**
 * Simulación de la transacción para el modo memoria (sin rollBack real).
 * Valida antes de modificar para mantener el mismo contrato que la versión PDO.
 */
function registrarSalidaStock(int $id, int $cantidad): bool {
    global $almacenMateriales, $auditoriaMemoria;

    if (!isset($almacenMateriales[$id]) || $almacenMateriales[$id]['stock'] < $cantidad) {
        error_log('Error en salida (memoria) para el material ID ' . $id);
        return false;
    }
    $anterior = $almacenMateriales[$id]['stock'];
    $almacenMateriales[$id]['stock'] -= $cantidad;
    array_unshift($auditoriaMemoria, [
        'id' => count($auditoriaMemoria) + 1,
        'nombre_material' => $almacenMateriales[$id]['nombre'],
        'cantidad' => $cantidad,
        'stock_anterior' => $anterior,
        'stock_nuevo' => $anterior - $cantidad,
        'fecha' => date('Y-m-d H:i:s')
    ]);
    return true;
}

function obtenerAuditoria(int $limite = 10): array {
    global $auditoriaMemoria;
    return array_slice($auditoriaMemoria, 0, $limite);
}
?>
