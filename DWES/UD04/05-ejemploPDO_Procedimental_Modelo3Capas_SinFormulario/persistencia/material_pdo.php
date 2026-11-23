<?php
// material_pdo.php → Implementación MySQL con PDO
require_once __DIR__ . "/conexion.php"; // crea la variable global $conexion

function obtenerMateriales(): array {
    global $conexion;
    try {
        $consulta = $conexion->query(
            'SELECT id, nombre, stock, unidad, ubicacion FROM materiales ORDER BY nombre'
        );
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error al listar materiales: ' . $e->getMessage());
        return [];
    }
}

function obtenerMaterialPorId(int $id): array|false {
    global $conexion;
    try {
        $consulta = $conexion->prepare(
            'SELECT id, nombre, stock, unidad, ubicacion FROM materiales WHERE id = :id'
        );
        $consulta->execute([':id' => $id]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error al obtener material: ' . $e->getMessage());
        return false;
    }
}

function insertarMaterial(string $nombre, int $stock, string $unidad, string $ubicacion): int|false {
    global $conexion;
    try {
        $consulta = $conexion->prepare(
            'INSERT INTO materiales (nombre, stock, unidad, ubicacion)
             VALUES (:nombre, :stock, :unidad, :ubicacion)'
        );
        $consulta->execute([
            ':nombre'    => $nombre,
            ':stock'     => $stock,
            ':unidad'    => $unidad,
            ':ubicacion' => $ubicacion
        ]);
        return (int) $conexion->lastInsertId();
    } catch (PDOException $e) {
        error_log('Error al insertar material: ' . $e->getMessage());
        return false;
    }
}

function eliminarMaterial(int $id): bool {
    global $conexion;
    try {
        $consulta = $conexion->prepare('DELETE FROM materiales WHERE id = :id');
        $consulta->execute([':id' => $id]);
        return $consulta->rowCount() > 0;
    } catch (PDOException $e) {
        error_log('Error al eliminar material: ' . $e->getMessage());
        return false;
    }
}

/**
 * Registra una salida de stock y su auditoría en una única operación atómica.
 * @param int $id       ID del material
 * @param int $cantidad Unidades que salen del inventario (> 0)
 * @return bool true si se confirma, false si hubo error y se abortó
 */
function registrarSalidaStock(int $id, int $cantidad): bool {
    global $conexion;

    try {
        $conexion->beginTransaction();

        // Bloqueamos la fila para evitar condiciones de carrera
        $consulta = $conexion->prepare(
            'SELECT nombre, stock FROM materiales WHERE id = :id FOR UPDATE'
        );
        $consulta->execute([':id' => $id]);
        $material = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($material === false) {
            throw new Exception('Material inexistente, ID ' . $id);
        }
        if ($material['stock'] < $cantidad) {
            throw new Exception('Stock insuficiente para el material ID ' . $id);
        }

        $stockNuevo = $material['stock'] - $cantidad;

        // 1) UPDATE del stock
        $upd = $conexion->prepare('UPDATE materiales SET stock = :nuevo WHERE id = :id');
        $upd->execute([':nuevo' => $stockNuevo, ':id' => $id]);

        // 2) INSERT en la auditoría (misma transacción)
        $aud = $conexion->prepare(
            'INSERT INTO auditoria_salidas
                (material_id, nombre_material, cantidad, stock_anterior, stock_nuevo)
             VALUES (:id, :nombre, :cantidad, :anterior, :nuevo)'
        );
        $aud->execute([
            ':id'       => $id,
            ':nombre'   => $material['nombre'],
            ':cantidad' => $cantidad,
            ':anterior' => $material['stock'],
            ':nuevo'    => $stockNuevo
        ]);

        $conexion->commit();
        return true;

    } catch (Exception $e) {
        // Cubre PDOException y las Exception propias
        if ($conexion->inTransaction()) {
            $conexion->rollBack();
        }
        error_log('Error en transacción de salida: ' . $e->getMessage());
        return false;
    }
}

function obtenerAuditoria(int $limite = 10): array {
    global $conexion;
    try {
        $consulta = $conexion->prepare(
            'SELECT id, nombre_material, cantidad, stock_anterior, stock_nuevo, fecha
             FROM auditoria_salidas ORDER BY id DESC LIMIT :limite'
        );
        $consulta->bindValue(':limite', $limite, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error al leer auditoría: ' . $e->getMessage());
        return [];
    }
}
?>
