<?php
require_once 'app/Model/empModel.php';

class EmpController
{
    private $empmodel;
    public function __construct($pdo)
    {
        $this->empmodel = new EmpModel($pdo);
    }

    public function emplivro($id_livro, $nome_livro, $nome_user)
    {
        if ($this->empmodel->emplivro($id_livro, $nome_livro, $nome_user)) {
            header('Location: catalogo.php');
            exit();
        } else {
            echo 'Não foi possível realizar o empréstimo.';
        }
    }

    public function devolverLivro($id_livro)
    {
        if ($this->empmodel->devolverLivro($id_livro)) {
            header('Location: catalogo.php');
            exit();
        } else {
            echo "Não foi possível realizar a devolução.";
        }
    }
    public function listarLivrosEmprestados($nome_user)
    {
        return $this->empmodel->listarLivrosEmprestados($nome_user);
    }

    public function listarHistorico() {
        return $this->empmodel->listarHistorico();
    }
}
