<?php
// material_repositorio.php → Puerta de entrada a la capa de persistencia.
// Elige la implementación según config. Las dos exponen las mismas funciones:
//   obtenerMateriales(): array
//   obtenerMaterialPorId(int $id): array|false
//   insertarMaterial(string $nombre, int $stock, string $unidad, string $ubicacion): int|false
//   eliminarMaterial(int $id): bool
//   registrarSalidaStock(int $id, int $cantidad): bool
//   obtenerAuditoria(int $limite = 10): array
require_once __DIR__ . "/configuracion.php";

if ($persistencia === 'memoria') {
    require_once __DIR__ . '/material_memoria.php';
} else {
    require_once __DIR__ . '/material_pdo.php';
}
?>
