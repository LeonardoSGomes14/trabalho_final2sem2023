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

$bookController = new bookController($pdo);
$emprestimoController = new EmpController($pdo);

$books = $bookController->listarbooks();

$booksPorCategoria = [];
foreach ($books as $book) {
    $categoria = $book['categoria'];
    if (!isset($booksPorCategoria[$categoria])) {
        $booksPorCategoria[$categoria] = [];
    }
    $booksPorCategoria[$categoria][] = $book;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emprestar'])) {
    $id_livro = $_POST['id_livro'];
    $livroNome = $_POST['nome'];
    $usuarioNome = $_SESSION['usuarioNomedeUsuario'];

    $emprestimoController->emplivro($id_livro, $livroNome, $usuarioNome);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['devolver'])) {
    $id_livro = $_POST['id_livro'];

    $emprestimoController->devolverLivro($id_livro);
}

?>
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons8-book-96.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Catálogo de livros</title>
</head>



<body>
    
</body>
</html>