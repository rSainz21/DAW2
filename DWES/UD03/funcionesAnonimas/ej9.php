<?php

function aplicar(array $datos, callable $fn):array{
    $resultado=[];
    foreach ($datos as $elemento) {
        $resultado[]=$fn($elemento);
    }
    return $resultado;
}





?>