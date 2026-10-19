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

for ($mes = 1; $mes <= 12; $mes++) {

    $primerDia = mktime(0, 0, 0, $mes, 1, $anio);
    $diaSemanaInicio = (int) date('N', $primerDia); 
    $diasDelMes = (int) date('t', $primerDia);      
    ?>

    <div class="mes">
        <table>
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
            
                // huecos antes de empezaar el mses
                for ($i = 1; $i < $diaSemanaInicio; $i++) {
                    echo "<td class='vacio'></td>";
                    $columna = $columna + 1;
                }

            
                for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                    $clase = "dia";

                    // $columna vale 5 para el sábado y 6 para el domingo
                    if ($columna >= 5) {
                        $clase = $clase . " finde";
                    }

                    // Marcar el día de hoy
                    if ($dia == date('j') && $mes == date('n') && $anio == date('Y')) {
                        $clase = $clase . " hoy";
                    }

                    echo "<td class='$clase'>$dia</td>";
                    $columna = $columna + 1;

                    // Al llegar a 7 celdas, nueva fila (salvo que sea el último día)
                    if ($columna == 7) {
                        $columna = 0;
                        if ($dia < $diasDelMes) {
                            echo "</tr><tr>";
                        }
                    }
                }

                // Celdas vacías para completar la última fila
                if ($columna > 0) {
                    for ($i = $columna; $i < 7; $i++) {
                        echo "<td class='vacio'></td>";
                    }
                }
                ?>
            </tr>
        </table>
    </div>

<?php
}