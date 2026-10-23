<?php
declare(strict_types=1);
 
/*
  ============================================================================
  EJERCICIO 1 · Conversor de monedas (única página)
  ============================================================================
  Enunciado resumido:
    - El usuario elige entre 3 monedas de origen y 3 de destino.
    - Una sola página PHP; el action del formulario se escribe con $_SERVER['PHP_SELF'].
    - Cuatro arrays: (1) monedas y descripción, (2) monedas y tipo de cambio,
      (3) resultado y monedas involucradas, (4) errores.
    - Validar: cantidad numérica y mayor que cero, admitiendo coma o punto decimal.
    - number_format para la salida y htmlspecialchars para tratar la entrada.
 
  ORDEN DEL ARCHIVO (orden de construcción del ejercicio):
    PASO 1  Datos: los cuatro arrays.
    PASO 2  Funciones: h(), validarNumero(), validarMoneda(), gestionarErrores(), convertir().
    PASO 3  Flujo de la página (formulario autogestionado):
              GET  -> se muestra el formulario con valores por defecto.
              POST -> Etapa 1 limpieza, Etapas 2-3 validación y errores, lógica (conversión).
    PASO 4  Etapa 4 · Salida: HTML con errores, formulario (valores escritos) y resultado.
*/
 
 
/* ==========================================================================
   PASO 1 · DATOS (los cuatro arrays que pide el enunciado)
   ========================================================================== */
 
// ARRAY 1: monedas y su descripción (código => descripción).
// "EUR - Euro" y "USD - Dólar (USD)" salen de la captura del enunciado.
// 'GBP' => 'Libra (GBP)' es la tercera moneda [dato de ejemplo inventado]
$monedas = [
    'EUR' => 'Euro',
    'USD' => 'Dólar (USD)',
    'GBP' => 'Libra (GBP)',
];

// ARRAY 2: monedas y su tipo de cambio.
// Se guarda cuántas unidades de cada moneda equivalen a 1 EUR.
//   'USD' => 1.10 sale de la captura del enunciado (100 EUR equivalen a 110 USD).
//   'GBP' => 0.85 es [dato de ejemplo inventado], no es una cotización real.
$tiposCambio = [
    'EUR' => 1.00,
    'USD' => 1.10,
    'GBP' => 0.85,
];
// ARRAY 3: resultado de la conversión y monedas involucradas en la solicitud.
// Empieza vacío; solo se rellena si la petición es correcta (más abajo, en el PASO 3).
$resultado = [];
 
// ARRAY 4: errores. Una entrada por campo con fallo; la clave es el nombre del campo
// (igual que el atributo name del HTML). Empieza vacío.
$errores = [];
 
// Array auxiliar: una entrada por campo correcto (la clave también es el nombre del campo).
$datos = [];

/* ==========================================================================
   PASO 2 · FUNCIONES
   ========================================================================== */
 
// Salida segura (Etapa 4): convierte los caracteres especiales de HTML en entidades
// para evitar XSS. ENT_QUOTES convierte comillas dobles y simples; 'UTF-8' es la codificación.
function h(string $s): string{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// Etapa 2 · Validación de un número con coma o punto decimal.
// Devuelve el número como float si es válido o null si no lo es (convención de los ejercicios resueltos).
function validarNumero(string $texto): ?float{
    // Se cambia la coma por el punto para tratar "12,5" igual que "12.5".
    // (str_replace(buscar, reemplazo, cadena): UT03-Programación código embebido.pdf)
    $texto=str_replace(',','.',$texto);
    // FILTER_VALIDATE_FLOAT devuelve el float si es válido y false si no (compara siempre con === false).
    $valor=filter_var($texto,FILTER_VALIDATE_FLOAT);
    return $valor===false?null:$valor;
}

// Etapa 2 · Validación de una moneda elegida en un select (valor único elegido).
// Solo se acepta si el código existe como clave en el array de monedas (lista de valores permitidos).
// Devuelve el código si es válido o null si no lo es.

function validarMoneda(string $codigo, array $monedas): ?string{
  return isset($monedas[$codigo]?$codigo:null);
  
  $errores=[];
  $datos=[];

  $cantidad=validarNumero($entrada['cantidad']);
  if($cantidad===null){
    $errores['cantidad']='Introduce una cantidad numerica valida';
  }else if($cantidad<=0){
    $errores['cantidad']='La cantidad debe de ser mayor que 0';
  }else{
    $datos['cantidad']=$cantidad;
  }

  $origen=validarMoneda($entrada['origen'],$monedas);
  if($origen===null){
    $errores['origen']='Introduce un origen valido';
  }else{
    $datos['origen']=$origen;
  }

  $destino=validarMoneda($entrada['destino'],$monedas);
  if($destino===null){
    $errores['destino']='Introduce un destino valido';
  }else{
    $datos['destino']=$destino;
  }

  return['errores'=>$errores,'datos'=>$datos];
  
}

// Lógica de negocio: convierte pasando por el euro.
//   cantidad / (unidades de la moneda origen por 1 EUR) * (unidades de la moneda destino por 1 EUR)
// Ejemplo: 100 EUR -> USD = 100 / 1.00 * 1.10 = 110
function convertir(float $cantidad, string $origen, string $destino, array $tiposCambio):?float{
  return $cantidad/$tiposCambio[$origen]*$tiposCambio[$destino];
}




?>