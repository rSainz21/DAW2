<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria Central</title>
</head>

<body>
    <header>
        <h3>Cafeteria Central</h3>
    </header>
    <?php
    $cliente = "Lucia Garcia";
    $producto = "cafe latte";
    $precio = 2.80;
    $cantidad = 3;
    $importe = $precio * $cantidad;
    $porcentajeIva = 10;
    $iva = $importe * ($porcentajeIva / 100);
    $total = $iva + $importe;
    ?>
    <table >
        <tr>
            <th>Producto</th>
            <th>Precio </th>
            <th>Cantidad</th>
            <th>Importe</th>
        </tr>
        <tr>
            <td><?php echo $producto; ?></td>
            <td><?php echo number_format($precio, 2); ?> €</td>
            <td><?php echo $cantidad; ?></td>
            <td><?php echo number_format($importe, 2); ?> €</td>
        </tr>
    </table>

    <p>Subtotal: <?php echo number_format($importe, 2); ?> €</p>
    <p>IVA (<?php echo $porcentajeIva; ?>%): <?php echo number_format($iva, 2); ?> €</p>
    <p><strong>TOTAL: <?php echo number_format($total, 2); ?> €</strong></p>
</body>

</html>