<?php
declare(strict_types=1);

/*
  index.php: ÚNICA página a la que accede el navegador (controlador).
  Solo orquesta el flujo; no contiene datos, reglas ni HTML.
*/

require __DIR__ . '/src/entrada.php';
require __DIR__ . '/src/buscador.php';
require __DIR__ . '/src/helpers.php';

require __DIR__ . '/src/datos.php';

// Etapa 1: limpieza de la entrada
$q = limpiarBusqueda();

// Etapas 2 y 3: validación de la entrada. En este caso no lo pide el enunciado. 

// Lógica: búsqueda de resultados
$resultados =  buscarPorTitulo($peliculas, $q);

// Etapa 4: la plantilla muestra los valores ($q), los errores y los resultados
require __DIR__ . '/vistas/pagina.php';
