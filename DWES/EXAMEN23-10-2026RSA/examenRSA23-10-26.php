<?php
$actividades=[
    'surf'=>'surf en somo',
    'kayak'=>'kayak en el cantabrico',
    'senderismo'=>'senderismo en picos de europa',
    'cañones'=>'decenso de cañones',
    'espeleologia'=>'espeleologia',
    'bici'=>'ruta en bici por la costa'
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="#">
</head>

<body>
    <h1>Reserva de actividades de aventura</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
        <label for="titular">Titular de la reserva:</label>
        <input type="text" id="titular" name="titular" value="<?= h($_SERVER['entrada']) ?>">

        <label for="personas">Numero de personas del 1 al 10:</label>
        <input type="text" id="personas" name="personas" value="<?= h($_SERVER['personas']) ?>">

        <label for="actividades">Actividades</label>
        <input type="checkbox" id="actividades" name="actividades" value="">

        <button type="submit">Reservar</button>


    </form>
</body>

</html>