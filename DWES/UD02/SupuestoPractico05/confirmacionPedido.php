<?php require "datosCompra.php"; ?>
<?php
$porcentajeIva = 21;
$subtotal = $precio * $cantidad;
$baseImponible = $subtotal + $envio;
$iva = $baseImponible * ($porcentajeIva / 100);
$total = $baseImponible + $iva;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="confirmacionCompraStyle.css">
</head>

<body>
    <div class="contenedor">
        <h1>CONFIRMACION DE COMPRA</h1>
        <p>Por favor, <?= $cliente ?>, revise los datos antes de continuar:</p>
        <h2>Resumen del pedido</h2>
        <table>
            <tr>
                <th>Nº Pedido</th>
                <td id="numero-pedido"><?= $pedido ?></td>
            </tr>
            <tr>
                <th>Producto</th>
                <td><?= $pedido ?></td>
            </tr>
            <tr>
                <th>Precio Unidad</th>
                <td><?= $precio ?></td>
            </tr>
            <tr>
                <th>Unidades</th>
                <td><?= $cantidad ?></td>
            </tr>
            <tr>
                <th>Subtotal</th>
                <td><?= $subtotal ?></td>
            </tr>
            <tr>
                <th>Envio</th>
                <td><?= $envio ?></td>
            </tr>
            <tr>
                <th>Base Imponible</th>
                <td><?= $baseImponible ?></td>
            </tr>
            <tr>
                <th>IVA</th>
                <td><?= $iva ?></td>
            </tr>
            <tr>
                <th>Total</th>
                <td class="total"><?= $total ?></td>
            </tr>
        </table>
        <h2>Datos de entrega</h2>
        <form action="#">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="Carlos Pérez S.L.">

            <label for="cif">CIF</label>
            <input type="text id=cif" name="cif" value="B876321">

            <label for="urgente">Solicitar envio urgente</label>
            <input type="checkbox" id="urgente" name="urgente" value="1">

            <label for="direccion">Direccion</label>
            <textarea name="direccion" id="direccion">Calle Real 25,Santander</textarea>

            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones">Entregar por la mañana</textarea>

            <button type="submit" name="accion" value="modificar">Modificar datos</button>
            <button type="submit" name="accion" value="confirmar">Confirmar pedido</button>
        </form>


    </div>

</body>

</html>