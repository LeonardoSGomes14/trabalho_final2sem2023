<?php

require_once 'db/config.php';
require_once 'app/Controller/bookController.php';
require_once 'app/Controller/empController.php';



session_start();

// Verifique se o usuário já está logado e redirecione-o para a página apropriada
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirecione para a página de dashboard ou outra página após o login
    exit();
}

include_once('db/config.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
}

$bookController = new bookController($pdo);
$emprestimoController = new EmpController($pdo);

$books = $bookController->listarbooks();

$booksPorgenero = [];
foreach ($books as $book) {
    $genero = $book['genero'];
    if (!isset($booksPorgenero[$genero])) {
        $booksPorgenero[$genero] = [];
    }
    $booksPorgenero[$genero][] = $book;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emprestar'])) {
    $IDlivro = $_POST['id_livro'];
    $livroNome = $_POST['nome'];
    $usernome = $_SESSION['nome'];

    $emprestimoController->emplivro($IDlivro, $livroNome, $usernome);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['devolver'])) {
    $IDlivro = $_POST['id_livro'];

    $emprestimoController->devolverLivro($IDlivro);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/icons8-digital-library-96.png" type="image/x-icon">
    <title>Lista de Livros</title>
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
        <div class="user-info" id="user-info">

            <h3>Olá <?php echo $_SESSION['nome'], "!"; ?> </h3><br>

        </div>
        <div class="acervo">
            <h1>Nosso Acervo</h1>
        </div>
        <div class="livros">
            <?php foreach ($booksPorgenero as $genero => $booksNogenero) : ?>
                <div class="genero">
                    <h2><?php echo $genero; ?></h2><br>
                    <ul>
                        <?php foreach ($booksNogenero as $livro) : ?>
                            <li>
                                <div class="livrobox">
                                    <?php
                                    if (!empty($livro['imagem'])) {
                                        echo '<img src="' . $livro['imagem'] . '" alt="Imagem do Livro" width="100">';
                                    } else {
                                        echo 'Sem Imagem';
                                    }
                                    ?>
                                    <?php echo $livro['nome']; ?><br>
                                    <strong><?php echo $livro['qnt']; ?> Livro(s)</strong> Disponíveis
                                    <form method="post" action="catalogo.php">
                                        <input type="hidden" name="id_livro" value="<?php echo $livro['id_livro']; ?>">
                                        <input type="hidden" name="nome" value="<?php echo $livro['nome']; ?>">
                                        <button type="submit" name="emprestar">Emprestar</button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
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
                <a href="https://web.whatsapp.com"><img class="footericon" src="images/icons8-whatsapp-50.png" alt=""></a>
                <a href="https://www.instagram.com/"><img class="footericon" src="images/icons8-instagram-50.png" alt=""></a>
                <a href="https://www.facebook.com/"><img class="footericon" src="images/icons8-facebook-50.png" alt=""></a>
                <a href="https://twitter.com/"><img class="footericon" src="images/icons8-twitterx-50.png" alt=""></a>
            </div>
        </div>

    </footer>

</body>

</html>