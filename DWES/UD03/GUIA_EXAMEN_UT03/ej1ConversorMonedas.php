<?php
declare(strict_types=1);
//Array 1 moneda=>descripcion
$monedas=[
    'EUR'=>'EURO',
    'USD'=>'Dolar',
    'GBP'=>'Libra'
];
//array 2
$tiposCambio=[
    'EUR'=>1.00,
    'USD'=>1.10,
    'GBP'=>0.85
];
//arrray 3
$resultado=[];
$errores=[];
$datos=[];

function h(string $s): string{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

//etapa2
function validarNumero(string $texto): ?float{
    $texto=str_replace(',','.',$texto);
    $valor=filter_var($texto,FILTER_VALIDATE_FLOAT);
    return $valor===false? null:$valor;
}

function validarMoneda(string $codigo, array $monedas): ?string{
    return isset($monedas[$codigo])? $codigo:null;
}

function gestionarErrores(array $entrada, array $monedas): array{
    $errores=[];
    $datos=[];

    $cantidad=validarNumero($entrada['cantidad']);
    if($cantidad===null){
        $errores['cantidad']='Introduce una cantidad numerica valida';
    }elseif($cantidad<=0){
        $errores['cantidad']='La cantidad debe ser mayor que 0';
    }else{
        $datos['cantidad']=$cantidad;
    }

    $origen=validarMoneda($entrada['origen'],$monedas);
    if($origen===null){
        $errores['origen']='Introduce una moneda de origen valido';
    }else{
        $datos['origen']=$origen;
    }

    $destino=validarMoneda($entrada['destino'],$monedas);
    if($destino===null){
        $errores['destino']='Introduce una moneda de destino valido';
    }else{
        $datos['destino']=$destino;
    }
    return['errores'=>$errores,'datos'=>$datos];
}

function convertir(float $cantidad, string $origen, string $destino, array $tiposCambio): float{
    return $cantidad/$tiposCambio[$origen]*$tiposCambio[$destino];
}

$entrada=['cantidad'=>'','origen'=>'EUR','destino'=>'USD'];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $entrada=[
        'cantidad'=>trim($_POST['cantidad']??''),
        'origen'=>trim($_POST['origen']??''),
        'destino'=>trim($_POST['destino']??'')
    ];

    $validacion=gestionarErrores($entrada,$monedas);
    $errores=$validacion['errores'];
    $datos=$validacion['datos'];

    if(empty($errores)){
        $resultado=[
        'cantidad'=>$datos['cantidad'],
        'origen'=>$datos['origen'],
        'destino'=>$datos['destino'],
        'convertido'=>convertir($datos['cantidad'],$datos['origen'],$datos['destino'],$tiposCambio),
        'detalle'=>$monedas[$datos['origen']] . ' a ' . $monedas[$datos['destino']]
        ];
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de monedas</title>
</head>
<body>
    <h1>Conversor de monedas</h1>
    <?php if (!empty($errores)){ ?>
            <?php foreach($errores as $mensaje): ?>
                <p><?= h($mensaje) ?></p>
            <?php endforeach; ?>
    <?php } ?>

    <form method="post" action="<?= h($_SERVER['PHP_SELF']) ?>">
        <p>
            <label for="cantidad">Cantidad:</label>
            <input type="text" id="cantidad" name="cantidad" value="<?= h($entrada['cantidad']) ?>">
        </p>
        <p>
            <label for="origen">Origen:</label>
            <select name="origen" id="origen">
                <?php foreach($monedas as $codigo=>$descripcion){ ?>
                     <option value="<?= h($codigo) ?>" <?= $entrada['origen'] === $codigo ? 'selected' : '' ?>>
                        <?= h($codigo . ' - ' . $descripcion) ?>
                    </option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="destino">Origen:</label>
            <select name="destino" id="destino">
                <?php foreach($monedas as $codigo=>$descripcion){ ?>
                     <option value="<?= h($codigo) ?>" <?= $entrada['destino'] === $codigo ? 'selected' : '' ?>>
                        <?= h($codigo . ' - ' . $descripcion) ?>
                    </option>
                <?php } ?>
            </select>
        </p>
        <p><button type="submit">Convertir</button></p>
    </form>

    <?php if(!empty($resultado)){ ?>
        <h3>Resultado:</h3>
        <p>
            <?= number_format($resultado['cantidad'],2,',','.') ?> <?=
            h($resultado['origen']) ?> equivalen a <?=
            number_format($resultado['convertido'],2,',','.') ?> <?=
            h($resultado['destino']) ?>
        </p>
        <p>
            Detalle: <?= h($resultado['detalle']) ?>
        </p>
    <?php } ?>
</body>
</html>