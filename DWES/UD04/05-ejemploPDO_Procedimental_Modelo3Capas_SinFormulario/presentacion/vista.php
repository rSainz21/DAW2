<?php
// vista.php → Capa de presentación: muestra resultados y datos.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario de laboratorio</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 750px; margin: 2.5rem auto; padding: 0 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #e0e0e0; }
        th { background: #f8f9fa; font-weight: 600; }
        .msg-box { padding: 12px; margin: 8px 0; border-radius: 8px; font-weight: 500; }
        .success { background: #e6ffe6; color: #155724; border: 1px solid #c3e6cb; }
        .error   { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h1>Operaciones realizadas</h1>

    <div class="msg-box <?= $idNuevo !== false ? 'success' : 'error' ?>">
        <?= $idNuevo !== false ? '✅' : '❌' ?>
        CREATE – Alta de Pipetas Pasteur:
        <?= $idNuevo !== false ? 'insertado con ID ' . (int) $idNuevo : 'no se pudo insertar' ?>
    </div>

    <div class="msg-box <?= $materialInsertado !== false ? 'success' : 'error' ?>">
        <?= $materialInsertado !== false ? '✅' : '❌' ?>
        READ – Consulta del material recién insertado:
        <?= $materialInsertado !== false ? htmlspecialchars($materialInsertado['nombre']) . ' (ID ' . (int) $materialInsertado['id'] . ')' : 'no se pudo recuperar el material' ?>
    </div>

    <div class="msg-box <?= $salidaCorrecta ? 'success' : 'error' ?>">
        <?= $salidaCorrecta ? '✅' : '❌' ?>
        UPDATE – Salida de 2 unidades del material ID 1:
        <?= $salidaCorrecta ? 'operación confirmada y auditada' : 'operación abortada' ?>
    </div>

    <div class="msg-box <?= $salidaIncorrecta ? 'success' : 'error' ?>">
        <?= $salidaIncorrecta ? '⚠️' : '❌' ?>">
        <?= $salidaIncorrecta ? 'La operación se ha confirmado inesperadamente' : 'UPDATE – Salida de 9999 unidades del material ID 2: error esperado; transacción abortada (ROLLBACK)' ?>
    </div>

    <div class="msg-box <?= $bajaCorrecta ? 'success' : 'error' ?>">
        <?= $bajaCorrecta ? '✅' : '❌' ?>
        DELETE – Baja del material ID 4:
        <?= $bajaCorrecta ? 'material eliminado' : 'no se pudo eliminar (puede que no exista)' ?>
    </div>

    <h1>Inventario actualizado</h1>
    <?php if (!empty($materiales)): ?>
        <table>
            <thead>
                <tr><th>ID</th><th>Nombre</th><th>Stock</th><th>Unidad</th><th>Ubicación</th></tr>
            </thead>
            <tbody>
                <?php foreach ($materiales as $material): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) $material['id']) ?></td>
                        <td><?= htmlspecialchars($material['nombre']) ?></td>
                        <td><?= htmlspecialchars((string) $material['stock']) ?></td>
                        <td><?= htmlspecialchars($material['unidad']) ?></td>
                        <td><?= htmlspecialchars($material['ubicacion']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay materiales disponibles.</p>
    <?php endif; ?>

    <h1>Auditoría de salidas</h1>
    <?php if (!empty($auditoria)): ?>
        <table>
            <thead>
                <tr><th>#</th><th>Material</th><th>Cantidad</th><th>Stock anterior</th><th>Stock nuevo</th><th>Fecha</th></tr>
            </thead>
            <tbody>
                <?php foreach ($auditoria as $registro): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) $registro['id']) ?></td>
                        <td><?= htmlspecialchars($registro['nombre_material']) ?></td>
                        <td><?= htmlspecialchars((string) $registro['cantidad']) ?></td>
                        <td><?= htmlspecialchars((string) $registro['stock_anterior']) ?></td>
                        <td><?= htmlspecialchars((string) $registro['stock_nuevo']) ?></td>
                        <td><?= htmlspecialchars($registro['fecha']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aún no hay salidas registradas.</p>
    <?php endif; ?>
</body>
</html>
