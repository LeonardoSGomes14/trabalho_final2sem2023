<?php

// carregar composer 
require 'vendor/autoload.php';

// referenciar namespace dompdf
use Dompdf\Dompdf;

// instanciar e usar a classe dompdf
$dompdf = new Dompdf();

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
$dados .= "<img src='http://localhost/trabalho_final2sem2023y/imagens/testeimage2.jpeg''</br>'";
$dados .= "<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Optio, temporibus blanditiis? Beatae, fugiat! Voluptas veritatis autem molestiae facilis magni ut fuga eos. Mollitia inventore sunt dignissimos, iusto neque corporis expedita.</p>";
$dados .= "</body>";
$dados .= "</html>";
$dados .= "";
$dados .= "";
$dados .= "";
$dados .= "";
$dados .= "";
$dados .= "";





// instanciar o método LoadHtml e enviar o conteúdo do PDF 
$dompdf->loadHtml($dados);

//tamanho e orientação do papel
$dompdf->setPaper('A4', 'portrait');

//Renderizar o HTML como PDF 
$dompdf->render();

// Gerar o PDF 
$dompdf->stream();

echo "<h1>Gerar PDF com PHP</h1>";
