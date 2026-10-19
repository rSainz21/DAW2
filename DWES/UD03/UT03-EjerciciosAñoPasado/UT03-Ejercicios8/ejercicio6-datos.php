<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5-datos</title>
</head>
<body>
    <?php
    $menor=$_POST['menor'];
    $mayor=$_POST['mayor'];
    echo '<p>Lista de pares de numeros de '.$menor.' y '.$mayor.' : <br/>';
    for ($i=$menor; $i <=$mayor ; $i++) { 
        $j=$mayor-($i-$menor);
        print '('.$i.','.$j.') ';
    }  
    ?>
    <a href="ejercicio6.html">Volver</a>
</body>
</html>