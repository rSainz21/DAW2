<?php
declare(strict_types=1);

$nombres=['Lucia','Victor','Efren'];
echo $nombres[0];//array indexado

$monedas=[
    'EUR'=>'EURO',
    'USD'=>'Dolar',
]; //array asociativo
echo $monedas['USD'];

$peliculas=[
    'Volver'=>['anio'=>'2006','sinopsis'=>'Drama de Pedro'],
];
echo $peliculas['Volver']['anio'];

//truco de examen guardar errores y datos con la misma clave que el campo
$errores=[];
$datos=[];

$errores['cantidad']='Introducec una cantidad numerica valida';
$datos['origen']='EUR';
$cantidad=50;
//condicionales y bucles if ifelse y else
if($cantidad===null){
    $errores['cantidad']='Introduce una cantidad numerica valida';
}elseif($cantidad<=0){
    $errores['cantidad']='La cantidad debe de ser mayor que 0';
}else{
    $datos['cantidad']=$cantidad;
}

//foreach
foreach($errores as $mensaje){
    echo $mensaje;
}

foreach($monedas as $codigo=>$descripcion){
    echo $codigo . ' - ' . $descripcion;
}

for ($i=0;$i<10;$i++){
    $entrada[$i]=trim($numeros[$i]??'');
}

$suma=0;
foreach($numeros as $numero){
    $suma+=$numero;
}

//funciones
function validarEdad(string $edad):?int{
    $v=filter_var($edad,FILTER_VALIDATE_INT,['options'=>['min_range'=>18, 'max_range'=>65]]);
    return $v===false?null:$v;
}
$edad=validarEdad('30');
validarEdad($edad);

$nombre=validarNombre($entrada['nombre']);
if($nombre===null){
    $errores['nombre']='El niombre tiene que tener letras y espacios';
}else{
    $datos['nombre']=$nombre;
}


function validarMoneda(string $codigo, array $monedas): ?string{
    return isset($monedas[$codigo]) ? $codigo:null;
}

function gestionarErrores(array $entrada): array{
    $errores=[];
    $datos=[];
    return ['errores'=>$errores, 'datos'=>$datos];
}
$validacion = gestionarErrores($entrada);
$errores = $validacion['errores'];
$datos   = $validacion['datos'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // el usuario ha pulsado el botón: limpiar, validar, calcular
}
// si es GET (primera visita) no entra: se muestra el formulario con valores iniciales





































?>