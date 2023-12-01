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
    <title>Catálogo de livros</title>
</head>



<body>
    
</body>
</html>