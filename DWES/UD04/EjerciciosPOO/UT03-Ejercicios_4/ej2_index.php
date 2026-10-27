<?php

require_once('ej2.php');

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Pruebas de la clase Coche</title>
</head>
<body>
    <h1>Pruebas de la clase Coche</h1>

<?php

// Coche 1: uso normal
$coche1 = new Coche("1234 ABC", 50);
echo "<h3>Coche 1</h3>";
echo "<p>Creado con velocidad 50 (esperado: 50)</p>";
echo $coche1->muestra();

$coche1->acelera(30);
echo "<p>acelera(30) (esperado: 80)</p>";
echo $coche1->muestra();

$coche1->acelera(100);
echo "<p>acelera(100): se pasa del máximo (esperado: 120)</p>";
echo $coche1->muestra();

$coche1->frena(50);
echo "<p>frena(50) (esperado: 70)</p>";
echo $coche1->muestra();

$coche1->frena(100);
echo "<p>frena(100): se pasa del mínimo (esperado: 0)</p>";
echo $coche1->muestra();

// Coche 2: objeto independiente, con velocidad inicial fuera de rango
$coche2 = new Coche("5678 DEF", 150);
echo "<h3>Coche 2</h3>";
echo "<p>Creado con velocidad 150 (esperado: 120)</p>";
echo $coche2->muestra();

$coche2->frena(20);
echo "<p>frena(20) (esperado: 100)</p>";
echo $coche2->muestra();

// El coche 1 no se ha visto afectado por el coche 2
echo "<h3>Coche 1 otra vez</h3>";
echo "<p>Sigue en 0 (esperado: 0)</p>";
echo $coche1->muestra();

?>
</body>
</html>