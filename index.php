<?php
session_start();

// Verifique se o usuário já está logado e redirecione-o para a página apropriada
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirecione para a página de dashboard ou outra página após o login
    exit();
}

include_once('db/config.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons8-book-96.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Página Inicial</title>
</head>

<body>
    <div class="princ">
        <header>
            <div class="logo">
                <a href="index.php">
                    <img src="images/logomybiblio-removebg-preview.png" alt="logotipo">
                </a>
            </div>
            <nav class="nav-bar">
                <ul>
                    <li class="nav-bts"><a class="nav-link" href="sobre.php">SOBRE NÓS</a></li>
                    <li class="nav-bts"><a class="nav-link" href="catalogo.php">LIVROS</a></li>

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

<h1>CONTENT</h1>
    </section>





    <footer>
            <div class="logo">
                <a href="index.php">
                    <img src="images/logomybiblio-removebg-preview.png" alt="logotipo">
                </a>
            </div>

            <div>
              
              <a class="nav-link" href="sobre.php">Sobre nós</a>
              <a class="nav-link" href="privacidade.php">Política de Privacidade</a>
              <a class="nav-link" href="catalogo.php">Nosso Acervo</a>
            
            </div>


            <div>
                <div><p>Contate-nos</p></div>
                <div>
                    <a href=""><img class="footericon" src="images/icons8-whatsapp-50.png" alt=""></a>
                    <a href=""><img class="footericon" src="images/icons8-instagram-50.png" alt=""></a>
                    <a href=""><img class="footericon" src="images/icons8-facebook-50.png" alt=""></a>
                    <a href=""><img class="footericon" src="images/icons8-twitterx-50.png" alt=""></a>
                </div>
            </div>

    </footer>


</body>

</html>