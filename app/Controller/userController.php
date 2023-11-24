<?php
require_once 'app/Model/userModel.php';

class userController
{

    private $usermodel;

    public function _construct($pdo) {
        $this->usermodel = new usermodel($pdo);
    }


    public function criaruser($nome, $email, $senha, $alvl){
        $this->usermodel->criaruser($nome, $email, $senha, $alvl);
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