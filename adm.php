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






    <section class="vantadiv">
        <div class="admdiv">
            <img src="images/icons8-user-96.png" alt="">
            <h1>USUÁRIOS</h1>
            <h3>Administração de usuários</h3>
            <button><a href="adm_user.php">Entrar</a></button>
        </div>

        <div class="admdiv">
            <img src="images/icons8-books-100.png" alt="">
            <h1>LIVROS</h1>
            <h3>Administração de livros</h3>
            <button><a href="adm_books.php">Entrar</a></button>
        </div>

        <div class="admdiv">
            <img src="images/icons8-library-100.png" alt="">
            <h1>EMPRÉSTIMOS</h1>
            <h3>Administração de empréstimos</h3>
            <button><a href="adm_emprestimos.php">Entrar</a></button>
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