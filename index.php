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
    <link rel="shortcut icon" href="images/icons8-digital-library-96.png" type="image/x-icon">
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
                    <li class="nav-bts"><a class="nav-link" href="#quemsomos">SOBRE NÓS</a></li>
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



        <div style="position: relative; width: 100%; height: 0; padding-top: 50.0000%;
 padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
 border-radius: 8px; will-change: transform;">
            <iframe loading="lazy"
                style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
                src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAF1utjvTQo&#x2F;view?embed"
                allowfullscreen="allowfullscreen" allow="fullscreen">
            </iframe>
        </div>

        <p class="vantadiv">___________________________________</p>


        <div class="vantadiv">
            <h2> Vantagens que só a biblioteca digital te oferece! </h2>
        </div>

        <p class="vantadiv">___________________________________</p>

        <div class="vantagens">
            <img src="images/Cópia de Longa história minimalista branco instagram post.png">
            <img src="images/Cópia de Longa história minimalista branco instagram post (1).png">
            <img src="images/Cópia de Longa história minimalista branco instagram post (2).png">
            <img src="images/Cópia de Longa história minimalista branco instagram post (3).png">
        </div>



        <p class="vantadiv">___________________________________</p>


        <div class="vantadiv">
            <h2> Quem somos </h2>
        </div>

        <p class="vantadiv">___________________________________</p>

        <div class="text">
            <p class="somos" id="quemsomos">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo dolor
                dignissimos minima dolorum
                suscipit, nisi nihil cumque vero similique quam deserunt voluptate quaerat numquam temporibus labore
                quas
                quod libero facere. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam consequatur dolorum
                minus saepe mollitia? Facilis omnis facere nulla, quis consectetur quod laborum, velit laudantium
                excepturi
                doloribus magni! Blanditiis, laudantium in!</p>
        </div>
    </section>


    <footer>
        <div class="logo">
            <a href="index.php">
                <img src="images/logomybiblio-removebg-preview.png" alt="logotipo">
            </a>
        </div>

        <div>

            <a class="nav-link" href="#quemsomos">Sobre nós</a>
            <a class="nav-link" href="privacidade.php">Política de Privacidade</a>
            <a class="nav-link" href="catalogo.php">Nosso Acervo</a>

        </div>


        <div>
            <div>
                <p>Contate-nos</p>
            </div>
            <div>
                <a href="https://web.whatsapp.com"><img class="footericon" src="images/icons8-whatsapp-50.png"></a>
                <a href="https://www.instagram.com/"><img class="footericon" src="images/icons8-instagram-50.png"></a>
                <a href="https://www.facebook.com/"><img class="footericon" src="images/icons8-facebook-50.png"></a>
                <a href="https://twitter.com/"><img class="footericon" src="images/icons8-twitterx-50.png"></a>
            </div>
        </div>

    </footer>


</body>

</html>