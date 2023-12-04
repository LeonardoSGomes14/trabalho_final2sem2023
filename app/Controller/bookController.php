<?php
require_once 'app/Model/bookModel.php';

class bookController
{
    private $bookmodel;

    public function __construct($pdo)
    {
        $this->bookmodel = new bookmodel($pdo);
    }

    public function criarbook($nome, $genero, $qnt, $autor, $imagem, $id_genero)
    {
        return $this->bookmodel->criarbook($nome, $genero, $qnt, $autor, $imagem, $id_genero);
    }

    public function listarbooks()
    {
        return $this->bookmodel->listarbooks();
    }

    public function atualizarbook($id, $nome, $genero, $qnt, $autor, $imagem, $id_genero)
    {
        $this->bookmodel->atualizarbook($id, $nome, $genero, $qnt, $autor, $imagem, $id_genero);
    }

    public function deletebooks($id)
    {
        $this->bookmodel->deletarbooks($id);
    }
}
?>
