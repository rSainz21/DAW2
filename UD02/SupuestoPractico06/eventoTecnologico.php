<?php require("datos.php");

$indicadorSesion=$sesionIniciada?"Logout":"Log in";
$tituloPanel=$sesionIniciada?"Area privada":"Acceso participantes";
$contenidoPanel=$sesionIniciada?"Hola, ".$nombre." tienes una reserva iniciada":"Inicia sesion para acceder a tu zona privada";

$temaBody=$modoOscuro?"modo-oscuro":"";
$mensajeTema=$modoOscuro?"modo oscuro activado":"modo claro activado";

$errorNombre=empty($nombre) ?"introduce un nombre":"";
$errorFecha=empty($fechaReserva) ?"fecha obligatoria":"";

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techlab Santander</title>
    <link rel="icon" href="#">
    <link rel="stylesheet" href="estilos.css">
</head>

<body class="<?=$temaBody?>">
    <header>
        <div>
            <h4><?= $nombreEvento ?> <?=$mensajeTema?></h4>
            <nav>
                <ul>
                    <li><a href="#"><?= $menuActivo ?></a></li>
                    <li><a href="#">Programa</a></li>
                    <li><a href="#"><?=$indicadorSesion?></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <h2><?= $nombreEvento ?></h2>
            <p><?= $mensajePublico ?></p>
            <p id="estado-sesion"><?=$tituloPanel?>:<?=$contenidoPanel?></p>
        </section>

        <section class="paneles">

            <div class="panel">
                <h2>Informacion</h2>
                <p>Fecha: <?= $fechaEvento ?></p>
                <p>Precio base: <?= $precioBase ?></p>
                <ul class="actividades">
                    <li>Desarrollo web</li>
                    <li>PHP en servidor</li>
                </ul>
            </div>

            <div class="panel">
                <h2>Intento anterior</h2>
                <p>Correo: <?= $email ?></p>
                <p>Horas: <?= $horas ?></p>
                <p>Total declarado: <?= $totalDeclarado ?></p>
                <p><?= $comentario ?></p>
            </div>

        </section>

        <section class="formulario">
            <div class="panel">
                <h2>Reserva</h2>
                <form id="form-registro" action="#" method="post">

                    <fieldset>
                        <legend>Datos personales</legend>

                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="<?= $nombre ?>">

                        <label for="email">Correo</label>
                        <input type="text" id="email" name="email" value="<?= $email ?>">
                    </fieldset>
                    <fieldset>
                        <legend>Reserva</legend>

                        <label for="horas">Horas adicionales</label>
                        <input type="text" id="horas" name="horas" value="<?= $horas ?>">

                        <label for="total"></label>
                        <input type="text" id="total" name="total" value="<?= $totalDeclarado ?>">

                        <label for="fecha"></label>
                        <input type="date" id="fecha" name="fecha" value="<?= $fechaReserva ?>">

                        <label for="comentario"></label>
                        <textarea name="comentario" id="comentario"><?= $comentario ?></textarea>

                    </fieldset>
                    <button type="submit" class="boton">Validar reserva</button>

                </form>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2026 Mi Panel. Todos los derechos reservados.</p>
    </footer>

</body>

</html>