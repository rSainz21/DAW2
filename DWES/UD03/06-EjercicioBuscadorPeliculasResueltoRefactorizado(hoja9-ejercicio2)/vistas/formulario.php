<?php /* Etapa 4: muestra el valor escrito y el error junto a su campo. */ ?>
<form method="get">
    <label for="q">Buscar por título:</label><br>
    <input id="q" name="q" type="text" value="<?= h($q) ?>"
           placeholder="Ej: Volver, Mar adentro, Tesis" autocomplete="off">
    <button type="submit">Buscar</button>

    <?php if ($q !== ''): ?>
        <a class="limpiar" href="index.php">Limpiar</a>
    <?php endif; ?>

</form>
