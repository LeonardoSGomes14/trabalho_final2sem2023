<?php
class bookmodel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarbook($nome, $genero, $qnt, $autor, $imagem, $id_genero)
    {
        $sql = "INSERT INTO livros (nome, genero, qnt, autor, imagem, id_genero) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $genero, $qnt, $autor, $imagem, $id_genero]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    //Listar book

    public function listarbooks()
    {
        $sql = "SELECT * FROM livros";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    //Atualizar book 

    public function atualizarbook($id_livro, $nome, $genero, $qnt, $autor, $imagem, $id_genero)
    {
        $sql = "UPDATE livros SET  nome = ?, genero = ?, qnt = ?, autor = ?, imagem = ?, id_genero = ? WHERE id_livro = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $genero, $qnt, $autor, $imagem, $id_genero, $id_livro]);
    }

    public function deletarbooks($id_livro) {
    $sql = "DELETE FROM livros WHERE id_livro = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id_livro]);
}
}

?>