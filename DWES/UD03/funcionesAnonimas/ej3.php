<?php

$sumar=function($numero):int{
    return ++$numero;
};

$multiplicar=function($numero):int{
    return $numero*2;
};

$potencia=function($numero):int{
    return $numero**2;
};

$funciones=[$sumar,$multiplicar,$potencia];

foreach($funciones as $funcion){
    echo $funcion(5) . PHP_EOL;
}
?>