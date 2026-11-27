<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CRUD Libros</title>
</head>

<body>

    <h1>CRUD Libros</h1>

    <h2>Nuevo libro</h2>

    <form action="index.php" method="post">

        <label>
            Título:
            <input
                type="text"
                name="titulo"
                required>
        </label>

        <br><br>

        <label>
            Precio:
            <input
                type="number"
                step="0.01"
                name="precio"
                required>
        </label>

        <br><br>

        <button
            type="submit"
            name="insertar">
            Insertar
        </button>

    </form>

    <hr>

    <h2>Transacción</h2>

    <p>
        Sustituye el libro <strong>Poesía</strong> por
        <strong>Poesía Completa</strong> (21 €): borra uno e inserta el otro
        en una única transacción.
    </p>

    <p>
        <strong>Precondición:</strong> debe existir un libro con el título
        exactamente <em>Poesía</em>. Si no existe, la transacción lanzará
        una excepción, se hará rollback y no se modificará nada.
    </p>

    <form action="index.php" method="post">

        <button
            type="submit"
            name="transaccion">
            Ejecutar transacción
        </button>

    </form>

    <hr>

    <h2>Listado de libros</h2>

    <table border="1" cellpadding="5">

        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Precio</th>
            <th>Actualizar</th>
            <th>Borrar</th>
        </tr>

        <?php foreach ($libros as $libro): ?>

            <tr>

                <form action="index.php" method="post">

                    <td>
                        <?= $libro->id ?>

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $libro->id ?>">
                    </td>

                    <td>
                        <input
                            type="text"
                            name="titulo"
                            value="<?= $libro->titulo ?>"
                            required>
                    </td>

                    <td>
                        <input
                            type="number"
                            name="precio"
                            step="0.01"
                            value="<?= $libro->precio ?>"
                            required>
                    </td>

                    <td>
                        <button
                            type="submit"
                            name="actualizar">
                            Actualizar
                        </button>
                    </td>

                    <td>
                        <button
                            type="submit"
                            name="borrar">
                            Borrar
                        </button>
                    </td>

                </form>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
