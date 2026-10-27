<?php
declare(strict_types=1);

/* LÓGICA DE NEGOCIO: búsqueda por título. No lee la petición ni imprime HTML. */

function buscarPorTitulo(array $peliculas, string $q): array
{
    $encontradas = [];

    foreach ($peliculas as $titulo => $info) {
        if (mb_stripos($titulo, $q) !== false) {
            $encontradas[$titulo] = $info;
        }
    }

    return $encontradas;
}
