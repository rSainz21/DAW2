<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UT3 Ejercicios-1</title>
</head>

<body>

    <h1>Ejercicios DWES</h1>
    <h3>Ejercicio 1. Tabla de multiplicar del 2</h3>

    <?php
    for ($i = 0; $i <= 10; $i++) {
        print ('2 x ' . $i . ' = ' . (2 * $i) . '<br/>');
    }

    $j = 0;
    while ($j <= 10) {
        print ('2 x ' . $j . ' = ' . (2 * $j) . '<br/>');
        $j++;
    }

    $k = 0;
    do {
        print ('2 x ' . $k . ' = ' . (2 * $k) . '<br/>');
        $k++;
    } while ($k <= 10);
    ?>

    <h3>Ejercicio 2. Dias del 1 a la fecha actual</h1>

        <?php
        $hoy = date('d');
        for ($i = 1; $i < $hoy; $i++) {
            print ('Dia: ' . $i . ' hasta dia: ' . $hoy . '<br/>');
        }
        ?>

        <h3>Ejercicio 3. Valor aleatorio</h3>

        <?php
        $random = rand(1, 5);

        if ($random == 1) {
            print ('tres');
        } elseif ($random == 2) {
            print ('dos');
        } elseif ($random == 3) {
            print ('tres');
        } elseif ($random == 4) {
            print ('cuatro');
        } else {
            print ('cinco');
        }

        switch ($random) {
            case 1:
                print ('uno');
                break;

            case 2:
                print ('dos');
                break;
            case 3:
                print ('tres');
                break;

            case 4:
                print ('cuatro');
                break;

            case 5:
                print ('cinco');
                break;
            default:
                print ('');
                break;
        }

        $texto = match ($random) {
            1 => 'uno',
            2 => 'dos',
            3 => 'tres',
            4 => 'cuatro',
            5 => 'cinco',
            default => ''
        };
        print $texto;
        ?>

        <h3>Ejercicio 4</h3>

        <?php
        $posicion = 'dentro';
        switch ($posicion) {
            case 'dentro':
                print ('La variable vale ' . $posicion);
                break;

            case 'fuera':
                print ('La variable vale ' . $posicion);
                break;

            default:
                print ('La variable no vale ni dentro ni fuera: ' . $posicion);
                break;
        }
        ?>

        <h3>Ejercicio 5</h3>

        <?php
        $posicion2 = 'fuera';
        $texto = match ($posicion2) {
            'dentro' => 'La variable vale ' . $posicion2,
            'fuera' => 'La variable vale ' . $posicion2,
            default => 'La variable no vale ni dentro ni fuera: ' . $posicion
        };
        print ($texto);
        ?>

        <h3>Ejercicio 6 Recorrer array</h3>

        <?php
        $numeros = [1, 9, 3, 8, 5, 7];
        foreach ($numeros as $numero) {
            print ('El doble del numero ' . $numero . ' es = ' . ($numero * 2) . '<br/>');
        }
        ?>

        <h3>Ejercicio 7</h3>

        <?php
        $productos = [
            "Manzana" => 5,
            "Plátano" => 3,
            "Naranja" => 4,
            "Kiwi" => 6
        ];
        foreach ($productos as $fruta => $precio) {
            $kilos = match ($fruta) {
                'Manzana' => 2,
                'Plátano' => 1.5,
                'Naranja' => 5,
                default => 0
            };

            if ($kilos > 0) {
                $subtotal = $kilos * $precio;
                print ($kilos . ' kg de ' . $fruta . ' a ' . $precio . ' el kilo da un subtotal de ' . $subtotal . ' euros<br/>');
                $total += $subtotal;
            }
        }
        print ('El precio total es de ' . $total . ' euros');
        ?>

        <h3>Ejercicio 8</h3>

        <?php
        $compra = [
            "Manzana" => 2,
            "Plátano" => 1.5,
            "Naranja" => 5
        ];
        $productos = [
            "Manzana" => 5,
            "Plátano" => 3,
            "Naranja" => 4,
            "Kiwi" => 6
        ];
        foreach ($productos as $fruta => $precio) {
            foreach ($compra as $frutaCompra => $kgs){
                
            }
        }




        ?>


</body>

</html>