<?php

$doble=fn($n) => $n*2;
echo $doble(6);

$esPar=fn($n) => $n%2===0;
var_dump($esPar(8));
var_dump($esPar(5));

?>