<?php if ($q === ''): ?>
    <p class="nota">Introduce un título (o parte de él) para buscar.</p>

<?php else: ?>
    <p><?= count($resultados) ?> resultado(s) para "<?= h($q) ?>".</p>
    <?php if (empty($resultados)): ?>
        <p>No se han encontrado películas con ese título.</p>
    <?php else: ?>
        <?php foreach ($resultados as $titulo => $info): ?>
        <article class="pelicula">
            <div class="titulo">
                <?= resaltar($titulo, $q) ?>
                <span class="anio">(<?= h((string) $info['anio']) ?>)</span>
            </div>
            <div class="sinopsis"><?= h($info['sinopsis']) ?></div>
        </article>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
