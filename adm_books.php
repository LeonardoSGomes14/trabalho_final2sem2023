<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/icons8-digital-library-96.png" type="image/x-icon">
    <title>Página do Administrador</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="images/logomybiblio-removebg-preview.png" alt="logotipo">
            </a>
        </div>
        <nav class="nav-bar">
            <ul>
                <li class="nav-bts"><a class="nav-link" href="index.php">HOME</a></li>
                <li class="nav-bts"><a class="nav-link" href="index.php#quemsomos">SOBRE NÓS</a></li>
                <li class="nav-bts"><a class="nav-link" href="catalogo.php">LIVROS</a></li>
                <li class="nav-bts"><a class="nav-link" href="useremp.php">MEUS EMPRÉSTIMOS</a></li>

            </ul>
        </nav>
        <div class="icone-l">
            <a class="text-user" href="login.php">
                <img id="user" src="images/user.png" alt="login">
                <p>Login</p>
            </a>
        </div>

        </div>
    </header>

    <section class="center">
        <div>
                <?php
                require_once 'db/config.php';
                require_once 'app/Controller/bookController.php';

                $pdo =
                    //configuração db
                    $host = 'localhost';
                $dbname = 'crud_biblio';
                $username = 'root';
                $password = '';

                // conexão PDO
                
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Erro ao conectar: " . $e->getMessage());
                }


                $mysqli = new mysqli($host, $username, $password, $dbname);

                if ($mysqli->error) {
                    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
                }



                $bookController = new bookController($pdo);
                $books = $bookController->listarbooks();

                ?>

                <!-- Exibir lista de usuários -->
                <legend>
                    <h1>Lista de Livros</h1>
                </legend>
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Gênero</th>
                            <th>ID Gênero</th>
                        </tr>
                    </thead>
                    <?php foreach ($books as $book): ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $book['id_livro']; ?>
                                </td>
                                <td>
                                    <?php echo $book['nome']; ?>
                                </td>
                                <td>
                                    <?php echo $book['qnt']; ?>
                                </td>
                                <td>
                                    <?php echo $book['genero']; ?>
                                </td>
                                <td>
                                    <?php echo $book['id_genero']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <tbody>
                </table>
        </div>

        <div class="formstyle">

      
        <h2>Atualizar Livro</h2>
        <form method="post">
            <label for="id_livro">Selecione o livro a ser atualizado:</label>
            <select name="id_livro">
                <?php foreach ($books as $book): ?>
                    <option value="<?php echo $book['id_livro']; ?>">
                        <?php echo $book['nome']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>
            <input type="text" name="nome" placeholder="Novo Título" required>
            <input type="text" name="genero" placeholder="Novo Gênero" required>
            <input type="text" name="qnt" placeholder="Nova Quantidade" required>
            <input type="text" name="autor" placeholder="Novo Autor" required>
            <input type="number" name="id_genero" placeholder="ID do Gênero" required><br>
            <input type="file" name="imagem" accept="image/*">
            <button class="botao "type="submit" name="atualizar" value="atualizar">Atualizar</button>
        </form>


        <div>
            <p>Cadastro</p>
        </div>

        <form method="post" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Nome do Livro" required><br>
            <input type="text" name="genero" placeholder="Gênero" required><br>
            <input type="text" name="qnt" placeholder="Quantidade" required><br>
            <input type="text" name="autor" placeholder="Autor" required><br>
            <input type="number" name="id_genero" placeholder="ID do Gênero" required><br>
            <input type="file" name="imagem" accept="image/*"><br><br>
            <button class="botao" type="submit" name="cadastrar" value="cadastrar">Cadastrar</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['atualizar'])) {
                $id_livro = $_POST['id_livro'];
                $nome = $_POST['nome'];
                $genero = $_POST['genero'];
                $qnt = $_POST['qnt'];
                $autor = $_POST['autor'];
                $id_genero = $_POST['id_genero'];
                $imagem = $_POST['imagem'];

                // Chama método do controlador para atualizar livro
                $bookController->atualizarbook($id_livro, $nome, $genero, $qnt, $autor, $imagem, $id_genero);
                echo '<h3>Livro atualizado com sucesso!</h3>';
            }

            if (isset($_POST['excluir'])) {
                $id = $_POST['id_livro'];

                // Chama método do controlador para excluir livro
                $bookController->deletebooks($id);
                echo '<h3>Livro excluído com sucesso!</h3>';
            }

            if (isset($_POST['cadastrar'])) {
                $nome = $_POST['nome'];
                $genero = $_POST['genero'];
                $qnt = $_POST['qnt'];
                $autor = $_POST['autor'];
                $id_genero = $_POST['id_genero'];

                // Verifica se um arquivo de imagem foi enviado
                if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
                    $imagem_destino = "uploads/" . $_FILES["imagem"]["name"];
                    $imagem_temp = $_FILES["imagem"]["tmp_name"];
                    move_uploaded_file($imagem_temp, $imagem_destino);

                    // Chama método do controlador para cadastrar livro
                    $bookController->criarbook($nome, $genero, $qnt, $autor, $imagem_destino, $id_genero);
                    echo '<h3>Livro cadastrado com sucesso!</h3>';
                } else {
                    echo '<h3>Erro ao enviar a imagem.</h3>';
                }
            }
        }
        ?>
        <h2>Excluir Livro</h2>
        <form method="post">
            <label for="id_livro">Selecione o livro a ser excluído:</label>
            <select name="id_livro">
                <?php foreach ($books as $book): ?>
                    <option value="<?php echo $book['id_livro']; ?>">
                        <?php echo $book['nome']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>
            <button class="botao" type="submit" name="excluir" value="excluir">Excluir</button>
        </form>
        </div>
    </section>


    <footer>

        <div class="logo">
            <a href="index.php">
                <img src="images/logomybiblio-removebg-preview.png" alt="logotipo">
            </a>
        </div>

        <div>

            <a class="nav-link" href="index.php#quemsomos">Sobre nós</a>
            <a class="nav-link" href="privacidade.php">Política de Privacidade</a>
            <a class="nav-link" href="catalogo.php">Nosso Acervo</a>

        </div>


        <div>
            <div>
                <p>Contate-nos</p>
            </div>
            <div>
                <a href="https://web.whatsapp.com"><img class="footericon" src="images/icons8-whatsapp-50.png"
                        alt=""></a>
                <a href="https://www.instagram.com/"><img class="footericon" src="images/icons8-instagram-50.png"
                        alt=""></a>
                <a href="https://www.facebook.com/"><img class="footericon" src="images/icons8-facebook-50.png"
                        alt=""></a>
                <a href="https://twitter.com/"><img class="footericon" src="images/icons8-twitterx-50.png" alt=""></a>
            </div>
        </div>
    </footer>
</body>

</html>