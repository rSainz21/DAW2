<?php

echo "\$_POST", "<br>";
print_r($_POST);

echo "<br>", "\$_GET", "<br>";   
print_r($_GET);

echo "<br>", "El valor de la variable nombre es " . $_POST['nombre'] . ", <br>";
echo "<br>", "El valor de la variable usuario es " . $_POST['usuario'] . ", <br>";