<?php
require_once 'app/Model/userModel.php';

class userController
{

    private $usermodel;

    public function __construct($pdo) {
        $this->usermodel = new usermodel($pdo);
    }


    public function criarUser($nome, $email, $senha, $alvl){
        $this->usermodel->criarUser($nome, $email, $senha, $alvl);
    }


    public function listarusers() {
        return $this->usermodel->listarusers();
    }

    public function exibirListausers() {
        $users = $this->usermodel->listarusers();
        include 'Views/user/lista.php';
    }

    public function atualizaruser($id, $nome, $email, $senha, $alvl) { 
        $this->usermodel->atualizaruser($id, $nome, $email, $senha, $alvl);
    }

    public function deleteusers($id) {
        $this->usermodel->deletarusers($id);
    }
}

?>