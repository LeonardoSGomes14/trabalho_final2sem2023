<?php
require_once 'db/config.php';
require_once 'app/Controller/userController.php';
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cad.css">
    <title>Cadastro</title>
</head>

<body>


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

    <div class="cad-log">
        <section id="container-cad">
            <div class="cad">
                <p>Cadastre-se</p>
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

                <input type="hidden" name="alvl" value="0" >

                <button class="botao" type="submit" name="submit" value="cadastrar">Cadastrar-se</button>
            </form>




        </section>


    </div>
</body>

</html>