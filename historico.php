
    <?php

    // carregar composer 
    require 'vendor/autoload.php';


    // incluir DB
    require_once 'db/config.php';

    // Query para recuperar registros do banco de dados
    $query_historico = "SELECT id_emp, nome_livro, nome_user, data FROM emprestimos";
    $result_historicos = $pdo->prepare($query_historico);
    $result_historicos->execute();

    //informações para o PDF
    $dados = "<!DOCTYPE html>";
    $dados .= "<html lang='pt-br'>";
    $dados .= "<head>";
    $dados .= "<meta charset='UTF-8'>";
    $dados .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $dados .= "<link rel='stylesheet' href='http://localhost/trabalho_final2sem2023y/css/csspdf.css'>";
    $dados .= "<title>Página Inicial</title>";
    $dados .= "</head>";
    $dados .= "<body>";
    $dados = "<h1>Leleo - Gerar PDF com PHP</h1>";

    //ler os registros
    foreach ( $result_historicos as $item){
        $dados .= "ID do empréstimo:" . $item['id_emp'] . "<br>";
        $dados .= "Nome do livro:" . $item ['nome_livro'] . "<br>";
        $dados .= "Nome do usuário:" . $item['nome_user'] . "<br>";
        $dados .= "Data:" . $item['data'] . "<br>";
        $dados .= "<hr>";
        $dados .= "</body>";
        $dados .= "</html>";
    }



    // referenciar namespace dompdf
    use Dompdf\Dompdf;

    // instanciar e usar a classe dompdf
    $dompdf = new Dompdf();



    // instanciar o método LoadHtml e enviar o conteúdo do PDF 
    $dompdf->loadHtml($dados);

    //tamanho e orientação do papel
    $dompdf->setPaper('A4', 'portrait');

    //Renderizar o HTML como PDF 
    $dompdf->render();

    // Gerar o PDF 
    $dompdf->stream();

    echo "<h1>Gerar PDF com PHP</h1>";
    ?>