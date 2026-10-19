<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio4-datos</title>
</head>

<body>
    <?php
    $numero = $_POST['numero'];
    $n = (int) $numero;
    $par = ($n % 2 === 0);


    if ($numero % 2 == 0) {
        print '<p>El numero ' . $numero . ' es par</p>';
    } else {
        print '<p>El numero ' . $numero . ' es impar</p>';
    }
    ?>
    <a href="ejercicio4.html">Volver</a>
</body>
</html>