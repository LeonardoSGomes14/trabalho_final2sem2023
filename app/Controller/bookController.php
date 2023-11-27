<?php
require_once 'app/Model/bookModel.php';

class bookController
{
    private $bookmodel;

    public function __construct($pdo)
    {
        $this->bookmodel = new bookmodel($pdo);
    }

    public function criarbook($nome, $genero, $qnt, $autor, $imagem)
    {
        $this->bookmodel->criarbook($nome, $genero, $qnt, $autor, $imagem);
    }

    public function listarbooks()
    {
        return $this->bookmodel->listarbooks();
    }

    public function exibirListabooks()
    {
        $books = $this->bookmodel->listarbooks();
        include 'Views/book/lista.php';
    }

    public function atualizarbook($id, $nome, $genero, $qnt, $autor, $imagem)
    {
        $this->bookmodel->atualizarbook($id, $nome, $genero, $qnt, $autor, $imagem);
    }

    public function deletebooks($id)
    {
        $this->bookmodel->deletarbooks($id);
    }
}
