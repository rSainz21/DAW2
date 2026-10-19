<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio4-datos</title>
</head>

<body>
    <?php
    function h($s){
        return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
    }
    $errores=[];
    $n=null;

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $numero=trim($_POST['numero']??'');//1.LIMPIEZA
        $n=filter_var($numero, FILTER_VALIDATE_INT);//2validacion

        if($numero===''){
            errores[]='debes de introducir un numero';

        }else if($n === false){
            
        }
    }

    $numero = $_POST['numero'];
    $n = (int) $numero;
    $par = ($n % 2 === 0);


    if ($numero % 2 == 0) {
        print '<p>El numero ' . $numero . ' es par</p>';
    } else {
        print '<p>El numero ' . $numero . ' es impar</p>';
    }
    ?>
    <a href="ejercicio4.html">Volver</a>
</body>
</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio4-datos</title>
</head>

<body>
    <?php

    // Solo se procesa si se ha llegado enviando el formulario (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // 1. LIMPIEZA
        $numero = trim($_POST['numero'] ?? '');

        // 2. VALIDACIÓN: devuelve el entero o false si no lo es
        $n = filter_var($numero, FILTER_VALIDATE_INT);
        // Alternativa leyendo directamente de la petición:
        // $n = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);

        // 3. GESTIÓN DE ERRORES
        if ($numero === '') {
            $errores[] = 'Debes introducir un número.';
        } elseif ($n === false) {
            $errores[] = 'El valor introducido no es un número entero.';
        }
    } else {
        $errores[] = 'Esta página solo funciona al enviar el formulario.';
    }

    if (empty($errores)) {
        // Sin errores: se comprueba si es par o impar
        if ($n % 2 === 0) {
            print '<p>El número ' . h($n) . ' es par</p>';
        } else {
            print '<p>El número ' . h($n) . ' es impar</p>';
        }
    } else {
        // Con errores: se muestran todos, escapados
        print '<ul>';
        foreach ($errores as $error) {
            print '<li>' . h($error) . '</li>';
        }
        print '</ul>';
    }
    ?>
    <a href="ejercicio4.html">Volver</a>
</body>

</html>