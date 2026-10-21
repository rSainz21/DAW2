<?php
declare(strict_types=1);

/* Ayudas de presentación: escapan la salida (XSS) y resaltan coincidencias. */

function h(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function resaltar(string $texto, string $q): string
{
    $pos = mb_stripos($texto, $q);
    if ($q === '' || $pos === false) {
        return h($texto);
    }

    $len = mb_strlen($q);

    return h(mb_substr($texto, 0, $pos))
        . '<mark>' . h(mb_substr($texto, $pos, $len)) . '</mark>'
        . h(mb_substr($texto, $pos + $len));
}
