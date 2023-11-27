<?php
class bookmodel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarbook($nome, $genero, $qnt, $autor, $imagem)
    {
        $sql = "INSERT INTO livros (nome, genero, qnt, autor, imagem) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $genero, $qnt, $autor, $imagem]);
    }


    //Listar book

    public function listarbooks()
    {
        $sql = "SELECT * FROM livros";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    //Atualizar book 

    public function atualizarbook($id, $nome, $genero, $qnt, $autor, $imagem)
    {
        $sql = "UPDATE livros SET  nome = ?, genero = ?, qnt = ?, autor = ?, imagem = ?
        WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $genero, $qnt, $autor, $imagem, $id]);
    }

    public function deletarbooks($id) {
    $sql = "DELETE FROM livros WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
}
}

?>