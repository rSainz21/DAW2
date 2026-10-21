<?php
declare(strict_types=1);

/*
  Ejercicio2 - Buscador didáctico de películas españolas
  Cambios:
  - Búsqueda SOLO por título.
  - Si el campo de búsqueda está vacío no se previsualizan resultados.
*/

// 1) Datos: array de películas
$peliculas = [
    "El espíritu de la colmena" => [
        "año" => 1973,
        "sinopsis" => "Una niña en la posguerra española queda fascinada por la película 'Frankenstein' y vive entre realidad y fantasía."
    ],
    "Volver" => [
        "año" => 2006,
        "sinopsis" => "Drama de Pedro Almodóvar sobre la familia, los secretos y la supervivencia de varias mujeres en La Mancha."
    ],
    "Tristana" => [
        "año" => 1970,
        "sinopsis" => "Relación compleja entre una joven huérfana y su tutor; retrato de poder y dependencia."
    ],
    "La vaquilla" => [
        "año" => 1985,
        "sinopsis" => "Comedia satírica sobre la Guerra Civil española: un grupo intenta robar una vaca utilizada en una fiesta franquista."
    ],
    "Los otros" => [
        "año" => 2001,
        "sinopsis" => "Thriller gótico sobre una mujer y sus hijos fotosensibles que viven en una mansión aislada con secretos inquietantes."
    ],
    "El laberinto del fauno" => [
        "año" => 2006,
        "sinopsis" => "Fábula oscura ambientada en la posguerra: una niña encuentra un mundo fantástico mientras su madre sufre con la brutalidad del régimen."
    ],
    "Mar adentro" => [
        "año" => 2004,
        "sinopsis" => "Historia real de Ramón Sampedro, un hombre tetrapléjico que luchó por su derecho a morir dignamente."
    ],
    "Ocho apellidos vascos" => [
        "año" => 2014,
        "sinopsis" => "Comedia romántica sobre los choques culturales entre un sevillano y una joven vasca."
    ],
    "La lengua de las mariposas" => [
        "año" => 1999,
        "sinopsis" => "Relato tierno y amargo sobre la amistad entre un niño y su maestro en la víspera de la Guerra Civil."
    ],
    "Tesis" => [
        "año" => 1996,
        "sinopsis" => "Suspense universitario sobre una estudiante que investiga la morbosa fascinación por las imágenes violentas."
    ],
    "Celda 211" => [
        "año" => 2009,
        "sinopsis" => "Un guardia de prisiones se ve atrapado en un motín y debe hacerse pasar por reo para sobrevivir."
    ],
    "La piel que habito" => [
        "año" => 2011,
        "sinopsis" => "Thriller psicológico de Pedro Almodóvar sobre venganza y ética científica."
    ],
];

// 2) Recoger búsqueda desde GET (solo título)
$q = trim((string)($_GET['q'] ?? ''));

// 3) Función de búsqueda: SOLO por título. Si $q está vacío devuelve array vacío (no previsualizar)
function buscarPeliculasPorTitulo(array $peliculas, string $q): array {
    if ($q === '') return []; // no mostrar nada si no se busca
    $result = [];
    foreach ($peliculas as $titulo => $info) {
        if (mb_stripos($titulo, $q) !== false) {
            $result[$titulo] = $info;
        }
    }
    return $result;
}

// 4) Helpers para salida segura y resaltar coincidencias en el título
function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function resaltar(string $texto, string $q): string {
    if ($q === '') return h($texto);
    $pos = mb_stripos($texto, $q);
    if ($pos === false) return h($texto);
    $len = mb_strlen($q);
    $start = mb_substr($texto, 0, $pos);
    $match = mb_substr($texto, $pos, $len);
    $end = mb_substr($texto, $pos + $len);
    return h($start) . '<mark>' . h($match) . '</mark>' . h($end);
}

// 5) Obtener resultados (solo si hay término de búsqueda)
$resultados = buscarPeliculasPorTitulo($peliculas, $q);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Buscador (solo por título)</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body{font-family: Arial, sans-serif; padding:20px; max-width:900px}
        form{margin-bottom:16px}
        input[type="text"]{width:60%; padding:8px}
        button{padding:8px 12px}
        .pelicula{border-bottom:1px solid #ddd; padding:12px 0}
        .titulo{font-weight:700; font-size:1.1rem}
        .anio{color:#666; margin-left:8px}
        .sinopsis{margin-top:6px}
        mark{background:#ffea8a}
        .nota{color:#555; margin-bottom:12px}
    </style>
</head>
<body>
    <h1>Buscador de películas por título</h1>

    <!-- Formulario: envía por GET a la misma página -->
    <form method="get" action="<?= h($_SERVER['PHP_SELF']) ?>">
        <label for="q">Buscar por título:</label><br>
        <input id="q" name="q" type="text" value="<?= h($q) ?>" placeholder="Ej: Volver, Mar adentro, Tesis" autocomplete="off" />
        <button type="submit">Buscar</button>
        <?php if ($q !== ''): ?>
            <a href="<?= h($_SERVER['PHP_SELF']) ?>" style="margin-left:12px">Limpiar</a>
        <?php endif; ?>
    </form>

    <?php if ($q === ''): ?>
        <p class="nota">Introduce un título (o parte de él) para buscar.</p>
    <?php else: ?>
        <p><?= count($resultados) ?> resultado(s) para "<?= h($q) ?>".</p>
        <?php if (empty($resultados)): ?>
            <p>No se han encontrado películas con ese título.</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($resultados)): ?>
        <?php foreach ($resultados as $titulo => $info): ?>
            <article class="pelicula">
                <div class="titulo">
                    <?= resaltar($titulo, $q) ?>
                    <span class="anio">(<?= h((string)$info['año']) ?>)</span>
                </div>
                <!-- Siempre mostrar año y sinopsis -->
                <div class="sinopsis"><?= h($info['sinopsis']) ?></div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>