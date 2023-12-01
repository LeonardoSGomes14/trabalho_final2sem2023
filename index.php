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

    <header>
        <div class="princ">
            <a href="index.php"><img class="logo" src="images/icons8-digital-library-60.png" alt=""></a>
            <nav class="nav-bar">
    <ul>
        <li class="nav-bts"><a class="nav-link" href="sobre.html">LIVROS</a></li>
        <li class="nav-bts"><a class="nav-link" href="equipes.php">CONHEÇAS AS EQUIPES</a></li>
        <li class="nav-bts"><a class="nav-link" href="galeria.php">GALERIA</a></li>
        <li class="nav-bts"><a class="nav-link" href="index.php#sessao_not">NOTÍCIAS</a></li>
        <li class="nav-bts"><a class="nav-link" href="ingressos.php">ADQUIRA SEU INGRESSO</a></li>
    </ul>
</nav>
        <div class="icone-l">
            <a href="login.php">
                <img id="user" src="images/user.png" alt="login">
                <p class="text-user">Login</p>
            </a>
        </div>

        </div>
    </header>




    <section>
        <h1>Initial Page</h1>
        <a href="gerar_pdf.php">Gerar PDF</a>

    </section>





    <footer>

    </footer>


</body>

</html>