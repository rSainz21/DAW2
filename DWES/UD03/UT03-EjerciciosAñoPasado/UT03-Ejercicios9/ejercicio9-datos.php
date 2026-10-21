<?php
declare(strict_types=1);

$monedas = [
    'EUR' => 'Euro',
    'USD' => 'Dólar (USD)',
    'GBP' => 'Libra (GBP)'
];

$cambios=[
    'EUR'=> '1.00',
    'USD'=> '1.10',
    'GBP'=> '0.85'
];

$resultados=[];
$errores=[];
$numero = $_POST['numero'];
$n = (int) $numero;

function h($s){
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function limpiarTexto(){
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
}








?>