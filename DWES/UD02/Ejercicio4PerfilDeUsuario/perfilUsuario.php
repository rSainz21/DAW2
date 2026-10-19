<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f5;
            padding: 40px;
        }

        .perfil {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, .15);
            text-align: center;
        }

        .perfil img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .enlaces {
            margin-top: 25px;
        }

        .enlaces a {
            text-decoration: none;
            background: #1976d2;
            color: white;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
    <?php
    $nombre = "Roberto";
    $apellidos = "Sainz Arjona";
    $nombreUsuario = "rober123";
    $ciudad = "Cartes";
    $edad = 21;
    ?>
    <div class="perfil">
        <img src="<?= $nombreUsuario ?>.png" alt="Avatar">
        <h2><?= $nombre . " " . $apellidos ?></h2>
        <p>@<?= $nombreUsuario ?></p>
        <p><?= $ciudad ?></p>
        <p><?= $edad ?></p>

        <div class="enlaces">
            <a href="">Enviar mensaje</a>
            <a href="">Ver publicaciones</a>
            <a href="">Editar perfil</a>
        </div>
    </div>


</body>

</html>