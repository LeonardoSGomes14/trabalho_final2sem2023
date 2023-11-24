<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuários</title>
</head>

<body>
    <h1>Dados dos usuários</h1>

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
        </tr>

        <?php foreach ($users as $user) : ?>

            <tr>
                <td><?php echo $user['nome']; ?></td>
                <td><?php echo $user['email']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>