<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio7-datos</title>
</head>

<body>
    <?php
    $num1 = $_POST['primer'];
    $num2 = $_POST['segundo'];
    $operacion = $_POST['operacion'];

    $resultado = match ($operacion) {
        "suma" => $num1 + $num2,
        "resta" => $num1 - $num2,
        "producto" => $num1 * $num2,
        "cociente" => ($num2 != 0) ? $num1 / $num2 : null,
    };

    echo '<p>El resultado de realizar '.$operacion.' de los numeros '.$num1.' y '.$num2.' es '.$resultado.'</p>';
    ?>
    <a href="ejercicio7.html">Volver</a>
</body>

</html>