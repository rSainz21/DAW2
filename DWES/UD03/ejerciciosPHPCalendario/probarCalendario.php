<?php
$anio = 2026;
?>
<!DOCTYPE html>
<html lang="es">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario <?= $anio ?></title>
    <link rel="stylesheet" href="estilosCalendario.css">
</head>
 
<body>
 
    <h1>Calendario <?= $anio ?></h1>
 
    <div class="contenedor">
        <?php include 'funcionCalendario.php'; ?>
    </div>
 
</body>
 
</html>
 