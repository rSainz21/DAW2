<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5-datos</title>
</head>
<body>
    <?php
    $numero=$_POST['numero'];
    for ($i=0; $i <=10 ; $i++) { 
        print $numero.' x '.$i.' = '.($numero*$i).'<br/>';
    }  
    ?>
    <a href="ejercicio5.html">Volver</a>
</body>
</html>