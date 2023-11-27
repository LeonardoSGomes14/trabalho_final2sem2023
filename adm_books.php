<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location:login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Página do Administrador</title>
</head>

<body>
    <header>

    </header>





    <section>

        <div class="lista-noticias">

            <h2>LISTA DE LIVROS</h2>
            <?php
            require_once 'db/config.php';
            require_once 'app/Controller/bookController.php';
            require_once 'app/Model/bookModel.php';

            // Criar uma instância do modelo bookmodel
            $bookmodel = new bookmodel($pdo);

            // Criar uma instância do controlador bookController e passar o modelo
            $bookController = new bookController($bookmodel);



            //Atualizar usuário 
            if (
                isset($_POST['atualizar_nome']) &&
                isset($_POST['atualizar_genero']) &&
                isset($_POST['atualizar_qnt']) &&
                isset($_POST['atualizar_autor']) &&
                isset($_POST['atualizar_imagem']) &&
                isset($_POST['id'])
            ) {
                $bookmodel->atualizarbook(
                    $_POST['id'],
                    $_POST['atualizar_nome'],
                    $_POST['atualizar_genero'],
                    $_POST['atualizar_qnt'],
                    $_POST['atualizar_autor'],
                    $_POST['atualizar_imagem']
                );
            }


            // Exibir usuários - removido o trecho redundante
            $books = $bookmodel->listarbooks();

            ?>

            <!-- Exibir lista de usuários -->
            <ul>
                <?php foreach ($books as $book) : ?>
                    <li>
                        nome: <?php echo $book['nome']; ?>
                        Gênero: <?php echo $book['genero']; ?>
                        Quantidade: <?php echo $book['qnt']; ?>
                        Autor: <?php echo $book['autor']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <!-- atualizar dados -->
        <h2>Atualizar Dados do Livro</h2>
        <form method="post">
            <div class="cadastro-n">
                <select name="id">
                    <?php foreach ($books as $book) : ?>
                        <option value="<?php echo $book['id']; ?>">
                            <?php echo $book['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="atualizar_nome" placeholder="Nome">
                <input type="text" name="atualizar_genero" placeholder="Gênero">
                <input type="text" name="atualizar_qnt" placeholder=" Quantidade">
                <input type="text" name="atualizar_autor" placeholder="Autor">
                <input type="file" name="imagem" accept="image/*">
                <div class="inp"><button type="submit">Atualizar dados</button></div>
            </div>

            <?php
            if (isset($_POST['id'])) {
                $bookmodel->deletarbooks(
                    $_POST['id']
                );
            }
            ?>

            <h2>Excluir Livro</h2>
            <form method="post">
                <div class="cadastro-n">
                    <select name="id">
                        <?php foreach ($books as $book) : ?>
                            <option value="<?php echo $book['id']; ?>">
                                <?php echo $book['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="inp"><button type="submit">Deletar</button></div>

            </form>


            <?php
            session_start();

            if (!isset($_SESSION['id'])) {
                header("Location:login.php");
                exit();
            }

            ?>




            <div class="cad">
                <p>Cadastro</p>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="lab">
                    <label for="nome">Nome:</label>
                </div>

                <div class="inp">
                    <input type="text" name="nome" required><br>
                </div>

                <div class="lab">
                    <label for="genero">Gênero:</label>
                </div>

                <div class="inp">
                    <input type="text" name="genero" required><br>
                </div>

                <div class="lab">
                    <label for="qnt">Quantidade:</label>
                </div>

                <div class="inp">
                    <input type="text" name="qnt" required>
                </div>

                <div class="lab">
                    <label for="autor">Autor</label>
                </div>

                <div class="inp">
                    <input type="text" name="autor" required>
                </div>

                <div class="lab">
                    <label for="imagem">Foto da capa</label>
                </div>

                <div class="inp">
                    <input type="file" name="imagem" accept="image/*"><br><br>
                </div>

                <button class="botao" type="submit" name="submit" value="cadastrar" required>Cadastrar</button>
            </form>




            <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $pdo = // Defina sua conexão PDO aqui
                    $bookController = new bookController($pdo);

                $nome = $_POST["nome"];
                $genero = $_POST["genero"];
                $qnt = $_POST["qnt"];
                $autor = $_POST["autor"];


                // Verifica se um arquivo de imagem foi enviado
                if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
                    $imagem_destino = "uploads/" . $_FILES["imagem"]["name"];
                    $imagem_temp = $_FILES["imagem"]["tmp_name"];
                    move_uploaded_file($imagem_temp, $imagem_destino);

                    // Chama o método do controlador para criar um livro
                    $bookController->criarbook($nome, $genero, $qnt, $autor, $imagem_destino);
                    echo '<h1 class="echonews">Livro cadastrado com sucesso!</h1>';
                } else {
                    echo '<h1 class="echonews">Erro ao enviar a imagem.</h1>';
                }
            }
            ?>


    </section>

    <footer>

    </footer>
</body>

</html>