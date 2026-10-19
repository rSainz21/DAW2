<?php require "Datos.php";

$imagenSesion = $sesionIniciada ? $nombre : "visitante";
$textoBienvenida = $sesionIniciada ? $nombre : "visitante";
$enlaceSesion = $sesionIniciada ? "logout" : "login";
$textoEnlaceSesion = $sesionIniciada ? "cerrar sesion" : "iniciar sesion";

$PRECIO_MODULO = 33.33;
$IVA = 0.21;
$totalModulos = $dwes + $daw + $dwec + $piDaw + $devopsDaw + $ipe2Daw + $digDaw;
$precioCalculado = $totalModulos * $PRECIO_MODULO * (1 + $IVA);
$comparaImporte = ($precioCalculado == $precioPagado) ? "correcto" : "error";
$mensajeImporte = ($precioCalculado == $precioPagado) ? "Importe correcto" : "El importe no coincide";

$nombre ??= "";
$email ??= "";
$anioNacimiento ??= "";

$errorNombre = empty($nombre) ? "Nombre obligatorio" : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Roberto</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="#">
</head>

<body>
    <header>
        <img class="avatar" src="img/<?= $imagenSesion ?>.png">
        <h1>Bienvenido/a <?= $textoBienvenida ?></h1>
        <a href="<?= $enlaceSesion ?>.php"><?= $textoEnlaceSesion ?></a>
    </header>
    <main>
        <section class="<?= $comparaImporte ?>">
            <h2><?=$totalModulos?></h2>
            <h2>Precio matricula</h2>
            <table>
                <tr>
                    <th>Concepto</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td>Modulos matriculados</td>
                    <td><?= $totalModulos ?></td>
                </tr>
                <tr>
                    <td>Importe calculado</td>
                    <td><?= $precioCalculado ?></td>
                </tr>
                <tr>
                    <td>Importe pagado</td>
                    <td><?= $precioPagado ?></td>
                </tr>
            </table>
            <p><?= $mensajeImporte ?></p>
        </section>
        <section>
            <h2>Datos personales</h2>
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?= $nombre ?>">
                <p><?= $errorNombre ?></p>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= $email ?>">

                <label for="anioNac">Año de nacimiento</label>
                <input type="number" id="anioNac" name="anioNac" required>
            </fieldset>
            <fieldset>
                <h2>Modulos matriculados</h2>
                <div class="lista-modulos">

                    <input type="checkbox" name="dwec" id="dwec" value="<?= $dwec ? "checked" : "" ?>">

                    <input type="checkbox" name="dwes" id="dwes">

                    <input type="checkbox" name="" id="">

                    <input type="checkbox" name="" id="">

                    <input type="checkbox" name="" id="">

                    <input type="checkbox" name="" id="">

                    <input type="checkbox" name="" id="">

                    <input type="checkbox" name="" id="">

                </div>
            </fieldset>
            <fieldset>
                <h2>Modalidades especiales</h2>
                <p class="modalidades">Dual</p>
                <section>
                    <h2>Preferencia de empresa DUAL</h2>
                    <p><?= $preferenciaEmpresaDual ?></p>
                </section>
            </fieldset>
            <fieldset>
                <button class="confirmar" type="submit">Confirmar datos</button>
                <button class="modificar" type="submit">Modificar datos</button>
            </fieldset>
        </section>
    </main>
</body>

</html>