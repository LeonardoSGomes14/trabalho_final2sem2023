<?php
class usermodel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    //Criar User

    public function criaruser($nome, $email, $senha, $alvl)
    {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $email, $senha, $alvl]);
    }

    //Listar user

    public function listarusers()
    {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    //Atualizar user 

    public function atualizaruser($id, $nome, $email, $senha, $alvl)
    {
        $sql = "UPDATE usuarios SET  nome = ?, email = ?, senha = ?, alvl = ?
        WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $email, $senha, $alvl, $id]);
    }
}
?>