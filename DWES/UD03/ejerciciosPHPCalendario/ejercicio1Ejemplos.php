<?php
$nombresMes = [
    '',
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre'
];
$anio = "2026";
$primerDia = mktime(0, 0, 0, $mes, 1, $anio);
$diaSemanaInicio = date('N', $primerDia);
$diasDelMes = date('t', $primerDia);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calendario</title>
</head>

<body>

    <h1>Calendario <?= $anio ?></h1>

    <?php
    for ($mes = 1; $mes <= 12; $mes++) {
        $primerDia = mktime(0, 0, 0, $mes, 1, $anio);
        $diaSemanaInicio = date('N', $primerDia);
        $diasDelMes = date('t', $primerDia);
        ?>

        <table border="1">
            <caption><?= $nombresMes[$mes] . " " . $anio ?></caption>
            <tr>
                <th>L</th>
                <th>M</th>
                <th>X</th>
                <th>J</th>
                <th>V</th>
                <th>S</th>
                <th>D</th>
            </tr>
            <tr>
                <?php
                $columna = 0; 
            
                // huecsos de dias vacios al principiop
                for ($i = 1; $i < $diaSemanaInicio; $i++) {
                    echo "<td></td>";
                    $columna = $columna + 1;
                }

                // pinta los diaas del mes
                for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                    echo "<td>$dia</td>";
                    $columna = $columna + 1;

                    // llega 7 y hace nueva filia
                    if ($columna == 7) {
                        $columna = 0;
                        if ($dia < $diasDelMes) {
                            echo "</tr><tr>";
                        }
                    }
                }

                // huecos daias vacios al final
                if ($columna > 0) {
                    for ($i = $columna; $i < 7; $i++) {
                        echo "<td></td>";
                    }
                }
                ?>
            </tr>
        </table>

    <?php
    }
    ?>

</body>

</html>