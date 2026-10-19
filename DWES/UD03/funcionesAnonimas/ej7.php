<?php

function calcular(callable $operacion,int|float $a, int|float $b){
    return $operacion($a,$b);
}

$suma=fn($x,$y) => $x+$y;
$resta=fn($x,$y) => $x+$y;
$multiplica=fn($x,$y) => $x*$y;


?>