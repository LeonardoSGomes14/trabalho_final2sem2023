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
    <link rel="shortcut icon" href="images/icons8-book-96.png" type="image/x-icon">
    <title>Página do Administrador</title>
</head>

<body>
    <header>

    </header>





    <section>
        <div>
            <button><a href="adm_user.php">Administração de Usuários</a></button>
        </div>

        <div>
            <button><a href="adm_books.php">Administração de Livros</a></button>
        </div>

        <div>
            <button><a href="adm_emprestimos.php">Administração de Emprestimos</a></button>
        </div>



    </section>







    <footer>

    </footer>
</body>

</html>