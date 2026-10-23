<?php
declare(strict_types=1);

$totalCajas=10;
$errores=[];
$datos=[];
$suma=null;

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function validarEntero(string $texto): ?int{
    $valor=filter_var($texto,FILTER_VALIDATE_INT);
    return $valor===false? null:$valor;
}

function gestionarErrores(array $entrada): array{
    $errores=[];
    $datos=[];
    foreach($entrada as $posicion=>$texto){
        $numero=validarEntero($texto);
        if($numero===null){
            $errores[$posicion]='Debe ser un numero entero';
        }else{
            $datos[$posicion]=$numero;
        }

    }
    return ['errores'=>$errores,'datos'=>$datos];
}

function sumar(array $numeros): float{
    $suma=0;
    foreach($numeros as $numero){
        $suma+=$numero;
    }
    return $suma;
}

$entrada=range(1,$totalCajas);
if($_SERVER['REQUEST_METHOD']==='POST'){
    $numeros=$_POST['numeros']?? [];
    if(!is_array($numeros)){
        $numeros=[];
    }

    $entrada=[];
    for($i=0;$i<$totalCajas;$i++){
        $entrada[$i]=trim($numeros[$i]??'');
    }

    $validacion=gestionarErrores($entrada);
    $errores=$validacion['errores'];
    $datos=$validacion['datos'];

    if(empty($errores)){
        $suma=sumar($datos);
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumar numeros</title>
</head>
<body>
    <h1>Sumar 10 numeros</h1>

    <form method="post" action="<?= h($_SERVER['PHP_SELF']) ?>">
        <?php foreach($entrada as $posicion =>$valor): ?>
            <p>
                <input type="text" name="numeros[]" value="<?= h((string)$valor) ?>">
                <?php if (isset($errores[$posicion])): ?>
                    <span><?= h($errores[$posicion]) ?></span>
                <?php endif; ?>
            </p>
        <?php endforeach; ?>
        <p><button type="submit">Sumar</button></p>
    </form>

    <?php if($suma !==null): ?>
        <p>La suma de los <?=$totalCajas ?> numeros es <?= h((string)$suma) ?></p>
    <?php endif ?>    
</body>
</html>