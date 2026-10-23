<?php
declare(strict_types=1);

$asignaturas=[
    'DWES'=>'Desarrollo web entorno servidor',
    'DWEC'=>'Desarrollo web entorno cliente',
    'DIW'=>'Desarrollo de interfaces web',
    'DAW'=>'Despliegue de aplicaciones web'
];

$evaluaciones=[
    'primera' => '1ª evaluación',
    'segunda' => '2ª evaluación',
    'final'   => 'Evaluación final'
];

$errores=[];
$datos=[];
$resultado=[];

function h(string $s): string{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function validarNombre(string $nombre): ?string{
    if (filter_var($nombre, FILTER_VALIDATE_REGEXP,
    ['options' => ['regexp' => '/^[a-záéíóúüñ ]+$/i']]) === false) {
        return null;
    }
    return $nombre;
}

function validarNumero(string $texto): ?float{
    $texto=str_replace(',','.',$texto);
    $valor=filter_var($texto,FILTER_VALIDATE_FLOAT);
    return $valor===false?null:$valor;
} 

function validarEvaluacion(string $codigo, array $evaluaciones): ?string{
    return isset($evaluaciones[$codigo])?$codigo:null;
}

function gestionarErrores(array $entrada, array $evaluaciones): array{

    $errores=[];
    $datos=[];

    $nombre=validarNombre($entrada['nombre']);
    if($nombre===null){
        $errores['nombre']='Introduce un nombre valido';
    }else{
        $datos['nombre']=$nombre;
    }

}

?>