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





    <section>

        <div class="lista-noticias">

            <h2>LISTA DE USUÁRIOS</h2>
            <?php
            require_once 'db/config.php';
            require_once 'app/Controller/userController.php';
            require_once 'app/Model/userModel.php';

            // Criar uma instância do modelo usermodel
            $usermodel = new usermodel($pdo);

            // Criar uma instância do controlador userController e passar o modelo
            $userController = new userController($usermodel);



            //Atualizar usuário 
            if (
                isset($_POST['atualizar_nome']) &&
                isset($_POST['atualizar_email']) &&
                isset($_POST['atualizar_senha']) &&
                isset($_POST['atualizar_alvl']) &&
                isset($_POST['id'])
            ) {
                $usermodel->atualizaruser(
                    $_POST['id'],
                    $_POST['atualizar_nome'],
                    $_POST['atualizar_email'],
                    $_POST['atualizar_senha'],
                    $_POST['atualizar_alvl']
                );
            }


            // Exibir usuários - removido o trecho redundante
            $users = $usermodel->listarusers();

            ?>

            <!-- Exibir lista de usuários -->
            <ul>
                <?php foreach ($users as $user) : ?>
                    <li>
                        nome: <?php echo $user['nome']; ?>
                        Email: <?php echo $user['email']; ?>
                        Senha: <?php echo $user['senha']; ?>
                        Nível de Acesso: <?php echo $user['alvl']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <!-- atualizar dados -->
        <h2>Atualizar Dados do usuário</h2>
        <form method="post">
            <div class="cadastro-n">
                <select name="id">
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['id']; ?>">
                            <?php echo $user['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="atualizar_nome" placeholder="Nome">
                <input type="text" name="atualizar_email" placeholder="Email">
                <input type="password" name="atualizar_senha" placeholder="Senha">
                <input type="text" name="atualizar_alvl" placeholder="Nível de Acesso">
                <div class="inp"><button type="submit">Atualizar</button>
        </form>
        </div>
        </div>

        <?php
        if (isset($_POST['id'])) {
            $usermodel->deletarusers(
                $_POST['id']
            );
        }
        ?>

        <h2>Excluir Usuário</h2>
        <form method="post">
            <div class="cadastro-n">
                <select name="id">
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['id']; ?>">
                            <?php echo $user['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="inp"><button type="submit">Deletar</button></div>

        </form>


        <?php

        if (isset($_POST['submit'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $alvl = $_POST['alvl'];

            $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE email = ? AND senha = ?');
            $stmt->execute([$email, $senha]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo 'Esse perfil já foi cadastrado.';
            } else {
                $userController = new userController($pdo);

                $userController->criarUser($nome, $email, $senha, $alvl);
                header("Location: login.php");
            }
        }
        ?>


        <div class="cad">
            <p>Cadastro</p>
        </div>

        <form method="post">
            <div class="lab">
                <label for="nome">Nome Completo:</label>
            </div>

            <div class="inp">
                <input type="text" name="nome" required><br>
            </div>



            <div class="lab">
                <label for="email">Email:</label>
            </div>

            <div class="inp">
                <input type="email" name="email" required><br>
            </div>



            <div class="lab">
                <label for="senha">Senha:</label>
            </div>

            <div class="inp">
                <input type="password" name="senha" required>
            </div>

            <div class="lab">
                <label for="alvl">Nível de Acesso</label>
            </div>

            <div class="inp">
                <input type="text" name="alvl" required>
            </div>

            <button class="botao" type="submit" name="submit" value="cadastrar">Cadastrar</button>
        </form>

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
                <a href="https://web.whatsapp.com"><img class="footericon" src="images/icons8-whatsapp-50.png" alt=""></a>
                <a href="https://www.instagram.com/"><img class="footericon" src="images/icons8-instagram-50.png" alt=""></a>
                <a href="https://www.facebook.com/"><img class="footericon" src="images/icons8-facebook-50.png" alt=""></a>
                <a href="https://twitter.com/"><img class="footericon" src="images/icons8-twitterx-50.png" alt=""></a>
            </div>
        </div>
    </footer>
</body>

</html>