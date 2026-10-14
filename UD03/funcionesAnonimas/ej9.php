<?php

function aplicar(array $datos, callable $fn):array{
    $resultado=[];
    foreach ($datos as $elemento) {
        $resultado[]=$fn($elemento);
    }
    return $resultado;
}

print_r(aplicar([1,2,3],fn($n) => $n*10)



?>