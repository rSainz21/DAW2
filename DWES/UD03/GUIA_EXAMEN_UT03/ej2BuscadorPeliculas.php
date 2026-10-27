<?php
declare(strict_types=1);

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

function h(string $s): string{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function limpiarBusqueda(): string{
    return trim($_GET['q']?? '');
}

function buscarPorTitulo(array $peliculas, string $q): array{
    if($q===''){
        return [];
    }
    $encontradas=[];
    foreach($peliculas as $titulo=>$info){
        if(strpos(strtolower($titulo),strtolower($q)) !==false){
            $encontradas[$titulo]=$info;
        }
    }
    return $encontradas;
}

$q=limpiarBusqueda();
$resultados=buscarPorTitulo($peliculas,$q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de peliculas</title>
</head>
<body>
    <h1>Buscador de peliculas</h1>

    <form method="get" action="<?= h($_SERVER['PHP_SELF']) ?>">
        <label for="q">Buscar por titulo:</label><br>
        <input type="text" id="q" name="q" value="<?= h($q) ?>">
        <button type="submit">Buscar</button>
        <?php if($q!==''){ ?>
            <a href="<?= h($_SERVER['PHP_SELF']) ?>">Limpiar</a>
        <?php } ?>
    </form>

    <?php if ($q===''){ ?>
        <p>Introduce un titulo o parte de el para buscar</p>
    <?php }else{ ?>
        <p><?= count($resultados) ?> resultados para "<?= h($q) ?></p>
        <?php if(empty($resultados)){ ?>
            <p>No se han encontrado resultados con ese titulo</p>
        <?php }else{
            foreach($resultados as $titulo=>$info){ ?>
                <article>
                    <div>
                        <?= h($titulo) ?>
                        <span> <?= h((string) $info['año']) ?> </span>
                    </div>
                    <div>
                        <?= h($info['sinopsis']) ?>
                    </div>
                </article>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</body>
</html>
