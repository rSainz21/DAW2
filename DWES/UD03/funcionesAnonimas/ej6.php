<?php

$larga=fn($cadena1,$cadena2):string => strlen($cadena1)>=strlen($cadena2)?$cadena1:$cadena2;
echo $larga("hola","adios");

?>