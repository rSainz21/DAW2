<?php

require_once('ej1.php');

echo "<h3>Pruebas de Circulo</h3>";

// 1. Constructor con radio
$c = new Circulo(5);
echo "<p>1. new Circulo(5) -> radio = " . $c->radio . " (esperado: 5)</p>";

// 2. Constructor sin parámetro
$vacio = new Circulo();
echo "<p>2. new Circulo() -> radio = " . $vacio->radio . " (esperado: 0)</p>";

// 3. Asignar con el método mágico __set
$c->radio = 7;
echo "<p>3. \$c->radio = 7 -> radio = " . $c->radio . " (esperado: 7)</p>";

// 4. Radio negativo: se queda en 0
$c->radio = -3;
echo "<p>4. \$c->radio = -3 -> radio = " . $c->radio . " (esperado: 0)</p>";

// 5. Texto numérico: se convierte a número decimal
$c->radio = "2.5";
echo "<p>5. \$c->radio = \"2.5\" -> radio = " . $c->radio . ", tipo " . gettype($c->radio) . " (esperado: 2.5, double)</p>";

// 6. Texto no numérico: se queda en 0
$c->radio = "abc";
echo "<p>6. \$c->radio = \"abc\" -> radio = " . $c->radio . " (esperado: 0)</p>";

// 7. Los métodos get y set de siempre siguen funcionando
$c->setRadio(10);
echo "<p>7. setRadio(10) y getRadio() -> " . $c->getRadio() . " (esperado: 10)</p>";

// 8. Leer un atributo que no existe: __get devuelve null
echo "<p>8. \$c->color es null: " . ($c->color === null ? "si" : "no") . " (esperado: si)</p>";

// 9. Asignar un atributo que no existe: __set lo ignora
$c->color = "rojo";
echo "<p>9. tras \$c->color = \"rojo\", \$c->color es null: " . ($c->color === null ? "si" : "no") . " (esperado: si)</p>";

?>