<?php
session_start();

// Verifique se o usuário já está logado e redirecione-o para a página apropriada
if (isset($_SESSION['id'])) {
    header("Location: logout.php"); // Redirecione para a página de dashboard ou outra página após o login
    exit();
}

include_once('db/config.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
}
?>
<?php
require_once 'db/config.php';
require_once 'app/Controller/userController.php';
?>

<?php

include_once('db/config.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    $sql_code = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $sql_code->execute([$email, $senha]);

    $quantidade = $sql_code->rowcount();

    if ($quantidade > 0) {
        $pdo = $sql_code->fetch(PDO::FETCH_ASSOC);


        $_SESSION['id'] = $pdo['id'];
        $_SESSION['nome'] = $pdo['nome'];
        $_SESSION['permissao'] = $pdo['alvl'];
        var_dump($_SESSION['permissao']);
        $alvl = $pdo['alvl'];


        switch ($alvl) {
            case 0:
                header("Location: index.php");
                break;
            case 1:
                header("Location: adm.php");
                break;
            default:
                echo "USUÁRIO SEM PERMISSÃO, FAVOR CONTATAR O ADMIN!!";
                break;
        }
    } else { echo'
  <script>
    function verificarCondicao() {
      // Simulação de uma condição qualquer
      var condicao = true;

      if (condicao) {
        exibirCaixaDialogo();
      }
    }

    // Função para exibir a caixa de diálogo
    function exibirCaixaDialogo() {
      var resposta = confirm("Algumas de sua credenciais estão incorretas, tente novamente!");
      if (resposta == true) {
     
      } else {
  
      }
    }
    window.onload = verificarCondicao;
  </script>
';

    }
}
?>

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

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title>Signin/Signup</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/cad.css">
    <link rel="shortcut icon" href="images/icons8-book-96.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <div class="container a-container" id="a-container">
            <form class="form" id="a-form" method="post">
                <h2 class="form_title title">Criar uma conta</h2>
                <div class="form__icons"><img class="form__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACd0lEQVR4nO2Zv2sUQRTHP+evwigSrCyiAWOpTXpBxcRcCkn8BVrZif+AjUJQSA5Jo4VpbMQiJtrE/CCojZ3YGEQx9nYaE6PRxOJWBp4Qwu7czuzb3Tm4L3zhmn1vPszsm7fvoKWWgtceoArUgGlgEfgO/BWb35+A58AI0CfPBKGKLGgSWAciR/8BJoAzEqsUXQDeeyw+yQvAYJEAR4BXigBb/QLoyhviHLCSI0QkXgUu5wFgzu9QAQDRFtc03x0TaKwEiEj8QAtmpESISHwnK8SlACAi8ZUs1emn0iLMffFQSraJux/YB7QDncBRYLRBjB/AYR8QrRL7EjiQIt/VFLHmXSHOK0HMAjtS5kwDYjyQFqKidGN/kyOEMsi7tFWsT2k3hh0gXEAioDdNwEklkGOWHN3Afcn1328dYo83gtjr2cXGVZjtFoiNjPF/A7ttIFXFTjZJj5Ry9NhAakpJXltyfCniHZxWSjKXEL8iX4saOaZsIJ8V74847VKKH8lnc6KWmgjkqw1ko4lA1rVBBqT522zbdKQ9wXcd85q1JmrZA+Q0Onri0QIlarFEENNDueT9aAs2WxLINmBNs/wOlwRySPvzt98j4HXpnza7y3Ihdsf4mkfeXhuIacR+eQQtuvyuAW2NtvlpE4BMkEI9TQByKg2IOccfAgZZwEFnAwapUuA4KC+QeTzUKVPxUEBWgIN4yjSE9QBA6sBFMup2ACBDKOleiSCjKOuGwzHTAKlr7kTcX2/LBYAsucx4s3SqMzmCTAEdFKh+y5jTB+SNzJ1L03HgsYxJXUFWZfJoYgQjs8iTwE0pDHHaCTwDbgEn5JmWWiJg/QOlYrQmouYwLQAAAABJRU5ErkJggg=="><img  class="form__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACwElEQVR4nO2ZSWsUURSFP5WYDoqiRiPigAvBP+BCiWsxDqigoMZf4EKIgqgrd6IoCCrOA1m5cCW208JFjCDGnWDiiANBQaIimnRi8uTJFZpQ1bxb9V5VteTAgV503fNOveneWzCB/xuzgE3AMeAW0AsMABVgWH73AWX5j/3vHAqCRqAduAv8BoySI8AdiTE1DwNNQAfQn2DwcewH9srLyQRtwGuPBsbzjWgEQwk4G9CAqeIYcF5m3ivmA08zMmGq+BhY4MvEUuBVDiaM8J2ciKkwV45MkyMP+dgTeSwnU8X9eMC5ep8Ji3UeBlKR9f0I6JZ9NpzlTDTJWZ5k8IPAJWC9LM3xmCZ3xGUxGsyExb6E5/5VYDHuWAR0hjJRSpB2/AK2p9C0z/7wacJiVwITqzzotuAZ95XLaQcFxGxgVGHkCgXFFuXppNnYmeKEwsgFx5iTgJ5APBwnelthZK3CiAmYGUfCNcMdUlRxIY18ixMdcAxgb30KYMQAM6NERxwfflggIwujRF0Tuu4CGVkeJfrV8eG3BTKyJEr0ZZ1tdgM0R4mWFQHaCmCkAkyJEj2uCHKxAEb64kQ3B0hRrJEjCvYoxnCzVtKo6d9ewy+mA58V+gdrBbunnN6dHo2cVGqvrBWsXRnMLrFWDya2SX3jqvsFaPBd6g7KC0hT6rpexv94yiVwR8JTpDPugopBc4qm+AoXgVKKXu+QtHo2xnTSG6TGt/vhe0KNB4qX9bfeMClpl8sHadB1Ac/EaNq4rShxxoOob94gAewSe1KAwRvhJ2AeKfpNrslkSI5KGzb1h568zezGE1pyWmZj0ov2CrtnTmdo4iewlYBYA7wIbKILWEYGsLOzB/jo2UCvJKKTyRiNkiuVFV2YqI7+dWBDXMWXNWbIYI5K0fNcstSKmLR9s/dy09u87ACwOubL1gSoZ/wB2IjAIiE1bGAAAAAASUVORK5CYII="><img class="form__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACvElEQVR4nO2ZTWsUQRCGn0P04pLE+3oQs1nBi/h1EPVg9GziX1GTP6CoR2MOGvHjP4gRsxtJBH+Cq7nHk27EGIyXtaWgGoaB+ejpWbsX9oUX9jBVXe9OVXVNN4wxRhRoA0tAF/gM7AOmJoov8dkBFnWt2nEO2Kgx6LL8CFysQ8AhYAX4G0CEUcraj4GJqiKOAu8DCjApbmhMzm8iRCqZAn4ADrsIWYkgaJPBZZfCDlkTpoAS29kyQmJMKZOitOhctAMH+AZoKtcKnm3lCVkKLKSZiOVYwbN38oR0RkjIep6Q7RqC6QPPgRuaqkeU8nseeAHsZtiuqQDh24J1vuQJ2fMQ8Bu4C0xSjCngntpUXW8vb4GqTndSLfE68Ez/tf3EQLgKXEu1+h2PdTNRVYTN7Vlgq4TNZqLrND3EZKJKOtk3cSUn97Nq6bLangcOQgqRmrBvwkVEUsyM+ngQSkhfi5aS6ZRFmbAF0xX+jFqESIu1hW08Oae+XoYQIvsE2p18hTxVXwshhEhdoC3WV4i0ZkE7hJCG2vyqQYj4EDRGXchP9TU56qnVC5la82qzWoOQJ+rrZgghMsWis5OvkKvq61XoDXHTQ4R8WtsN8UcIIUZHccFx4JvniPKwgn1tQg50FEcHwL6D7XfgktpeCD00mtQYP1PydFLS6YTayNfg14prZ8J4iJFR3GJOx46e7jPCT9qdbGHbN1FVhBnWp66kxn0t2iJMa038Gdan7raHY8tdnWJlADypE0BDfy9oi3XtTsb18CH0cZBx4Ls8IYsRBGhK8laekFYEARrHWS8T3QiCND6njBangUEEwZoMDspeK6B3diZSPsIBE5Gm2Jbr1Rt68RjTpU+35Gab+WaWA1/FDTSdKl9PJ3EKeB1ARAc4wxDQ0puidT3CqePgwVJ89XTHvl10tTbGGPwf/APThWw4L8JxcwAAAABJRU5ErkJggg=="></div><span class="form__span">ou use seu email para o registro</span>
                <input class="form__input" type="text" placeholder="Nome" name="nome" required>
                <input class="form__input" type="email" placeholder="Email" name="email" required>
                <input class="form__input" type="password" placeholder="Senha" name="senha" required>
                <input class="form__input" type="hidden" name="alvl" value="0">
                <button class="form__button button switch-btn " type='submit' name="submit" value="cadastrar">CADASTRAR-SE</button>
            </form>
            
        </div>
        <div class="container b-container" id="b-container">
            <form class="form" id="b-form" method="post">
                <h2 class="form_title title">Iniciar uma sessão</h2>
                <div class="form__icons"><img class="form__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACd0lEQVR4nO2Zv2sUQRTHP+evwigSrCyiAWOpTXpBxcRcCkn8BVrZif+AjUJQSA5Jo4VpbMQiJtrE/CCojZ3YGEQx9nYaE6PRxOJWBp4Qwu7czuzb3Tm4L3zhmn1vPszsm7fvoKWWgtceoArUgGlgEfgO/BWb35+A58AI0CfPBKGKLGgSWAciR/8BJoAzEqsUXQDeeyw+yQvAYJEAR4BXigBb/QLoyhviHLCSI0QkXgUu5wFgzu9QAQDRFtc03x0TaKwEiEj8QAtmpESISHwnK8SlACAi8ZUs1emn0iLMffFQSraJux/YB7QDncBRYLRBjB/AYR8QrRL7EjiQIt/VFLHmXSHOK0HMAjtS5kwDYjyQFqKidGN/kyOEMsi7tFWsT2k3hh0gXEAioDdNwEklkGOWHN3Afcn1328dYo83gtjr2cXGVZjtFoiNjPF/A7ttIFXFTjZJj5Ry9NhAakpJXltyfCniHZxWSjKXEL8iX4saOaZsIJ8V74847VKKH8lnc6KWmgjkqw1ko4lA1rVBBqT522zbdKQ9wXcd85q1JmrZA+Q0Onri0QIlarFEENNDueT9aAs2WxLINmBNs/wOlwRySPvzt98j4HXpnza7y3Ihdsf4mkfeXhuIacR+eQQtuvyuAW2NtvlpE4BMkEI9TQByKg2IOccfAgZZwEFnAwapUuA4KC+QeTzUKVPxUEBWgIN4yjSE9QBA6sBFMup2ACBDKOleiSCjKOuGwzHTAKlr7kTcX2/LBYAsucx4s3SqMzmCTAEdFKh+y5jTB+SNzJ1L03HgsYxJXUFWZfJoYgQjs8iTwE0pDHHaCTwDbgEn5JmWWiJg/QOlYrQmouYwLQAAAABJRU5ErkJggg=="><img  class="form__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACwElEQVR4nO2ZSWsUURSFP5WYDoqiRiPigAvBP+BCiWsxDqigoMZf4EKIgqgrd6IoCCrOA1m5cCW208JFjCDGnWDiiANBQaIimnRi8uTJFZpQ1bxb9V5VteTAgV503fNOveneWzCB/xuzgE3AMeAW0AsMABVgWH73AWX5j/3vHAqCRqAduAv8BoySI8AdiTE1DwNNQAfQn2DwcewH9srLyQRtwGuPBsbzjWgEQwk4G9CAqeIYcF5m3ivmA08zMmGq+BhY4MvEUuBVDiaM8J2ciKkwV45MkyMP+dgTeSwnU8X9eMC5ep8Ji3UeBlKR9f0I6JZ9NpzlTDTJWZ5k8IPAJWC9LM3xmCZ3xGUxGsyExb6E5/5VYDHuWAR0hjJRSpB2/AK2p9C0z/7wacJiVwITqzzotuAZ95XLaQcFxGxgVGHkCgXFFuXppNnYmeKEwsgFx5iTgJ5APBwnelthZK3CiAmYGUfCNcMdUlRxIY18ixMdcAxgb30KYMQAM6NERxwfflggIwujRF0Tuu4CGVkeJfrV8eG3BTKyJEr0ZZ1tdgM0R4mWFQHaCmCkAkyJEj2uCHKxAEb64kQ3B0hRrJEjCvYoxnCzVtKo6d9ewy+mA58V+gdrBbunnN6dHo2cVGqvrBWsXRnMLrFWDya2SX3jqvsFaPBd6g7KC0hT6rpexv94yiVwR8JTpDPugopBc4qm+AoXgVKKXu+QtHo2xnTSG6TGt/vhe0KNB4qX9bfeMClpl8sHadB1Ac/EaNq4rShxxoOob94gAewSe1KAwRvhJ2AeKfpNrslkSI5KGzb1h568zezGE1pyWmZj0ov2CrtnTmdo4iewlYBYA7wIbKILWEYGsLOzB/jo2UCvJKKTyRiNkiuVFV2YqI7+dWBDXMWXNWbIYI5K0fNcstSKmLR9s/dy09u87ACwOubL1gSoZ/wB2IjAIiE1bGAAAAAASUVORK5CYII="><img class="form__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACvElEQVR4nO2ZTWsUQRCGn0P04pLE+3oQs1nBi/h1EPVg9GziX1GTP6CoR2MOGvHjP4gRsxtJBH+Cq7nHk27EGIyXtaWgGoaB+ejpWbsX9oUX9jBVXe9OVXVNN4wxRhRoA0tAF/gM7AOmJoov8dkBFnWt2nEO2Kgx6LL8CFysQ8AhYAX4G0CEUcraj4GJqiKOAu8DCjApbmhMzm8iRCqZAn4ADrsIWYkgaJPBZZfCDlkTpoAS29kyQmJMKZOitOhctAMH+AZoKtcKnm3lCVkKLKSZiOVYwbN38oR0RkjIep6Q7RqC6QPPgRuaqkeU8nseeAHsZtiuqQDh24J1vuQJ2fMQ8Bu4C0xSjCngntpUXW8vb4GqTndSLfE68Ez/tf3EQLgKXEu1+h2PdTNRVYTN7Vlgq4TNZqLrND3EZKJKOtk3cSUn97Nq6bLangcOQgqRmrBvwkVEUsyM+ngQSkhfi5aS6ZRFmbAF0xX+jFqESIu1hW08Oae+XoYQIvsE2p18hTxVXwshhEhdoC3WV4i0ZkE7hJCG2vyqQYj4EDRGXchP9TU56qnVC5la82qzWoOQJ+rrZgghMsWis5OvkKvq61XoDXHTQ4R8WtsN8UcIIUZHccFx4JvniPKwgn1tQg50FEcHwL6D7XfgktpeCD00mtQYP1PydFLS6YTayNfg14prZ8J4iJFR3GJOx46e7jPCT9qdbGHbN1FVhBnWp66kxn0t2iJMa038Gdan7raHY8tdnWJlADypE0BDfy9oi3XtTsb18CH0cZBx4Ls8IYsRBGhK8laekFYEARrHWS8T3QiCND6njBangUEEwZoMDspeK6B3diZSPsIBE5Gm2Jbr1Rt68RjTpU+35Gab+WaWA1/FDTSdKl9PJ3EKeB1ARAc4wxDQ0puidT3CqePgwVJ89XTHvl10tTbGGPwf/APThWw4L8JxcwAAAABJRU5ErkJggg=="></div><span class="form__span">ou use sua conta de email</span>
                <input class="form__input" type="email" placeholder="Email" name="email" required>
                <input class="form__input" type="password" placeholder="Senha" name="senha" required>
                <button class="form__button button " name="signin">ENTRAR</button>
            </form>
        </div>
        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                <h2 class="switch__title title">LOGIN</h2>
                <p class="switch__description description">Para manter-se conectado, faça login com suas informações.</p>
                <button class="switch__button button switch-btn">ENTRAR</button>
            </div>
            <div class="switch__container is-hidden" id="switch-c2">
                <h2 class="switch__title title">CADASTRO</h2>
                <p class="switch__description description">Registre-se e comece sua jornada conosco!</p>
                <button class="switch__button button switch-btn">REGISTRAR-SE</button>
            </div>
        </div>
    </div>

    <script src="cadlog.js"></script>

    </div>


</body>

</html>