<?php
declare(strict_types=1);

/* ETAPA 1 · LIMPIEZA: lee y limpia el parámetro GET "q". No decide si es válido. */

function limpiarBusqueda(): string
{
    $valor = trim($_GET['q'] ?? '');

    return trim((string) $valor);
}
