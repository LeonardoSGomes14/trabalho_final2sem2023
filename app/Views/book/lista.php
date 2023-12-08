<!DOCTYPE html>
<html>

<head>
    <title>Lista de Livros</title>
</head>

<body>
    <?php
    $livrosPorgenero = [];
    foreach ($livros as $livro) {
        $genero = $livro['genero'];
        if (!isset($livrosPorgenero[$genero])) {
            $livrosPorgenero[$genero] = [];
        }
        $livrosPorgenero[$genero][] = $livro;
    }
    ?>

    <h1>Lista de Livros</h1>

    <?php foreach ($livrosPorgenero as $genero => $livrosNogenero) : ?>
        <div class="genero">
            <h2><?php echo $genero; ?></h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>genero_id</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livrosNogenero as $livro) : ?>
                        <tr>
                            <td>
                                <?php
                                if (!empty($livro['imagem'])) {
                                    echo '<img src="' . $livro['imagem'] . '" alt="Imagem do Livro" width="100">';
                                } else {
                                    echo 'Sem Imagem';
                                }
                                ?>
                            </td>
                            <td><?php echo $livro['id']; ?></td>
                            <td><?php echo $livro['nome']; ?></td>
                            <td><?php echo $livro['quantidade']; ?></td>
                            <td><?php echo $livro['id_genero']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</body>

</html>