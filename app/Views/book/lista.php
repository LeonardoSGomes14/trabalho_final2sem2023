<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros</title>
</head>

<body>
    <h1>Infromações dos Livros</h1>

    <table>
        <tr>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Autor</th>
            <th>Quantidade</th>
            <th>Capa</th>
        </tr>

        <?php foreach ($books as $book) : ?>

            <tr>
                <td><?php echo $book['nome']; ?></td>
                <td><?php echo $book['Gênero']; ?></td>
                <td><?php echo $book['Quantidade']; ?></td>
                <td><?php echo $book['Autor']; ?></td>
                <td><?php echo $book['imagem']; ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>