<?php

class EmpModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function empLivro($id_livro, $nome_livro, $nome_user) {
        $consultaLivro = $this->pdo->prepare("SELECT qnt FROM livros WHERE livro_id = ?");
        $consultaLivro->execute([$id_livro]);
        $book = $consultaLivro->fetch(PDO::FETCH_ASSOC);

        if ($book && $book['qnt'] > 0) {
            $novaQnt = $book['qnt'] - 1;
            $this->atualizarqnt($id_livro, $novaQnt);

            $inserirEmprestimo = $this->pdo->prepare("INSERT INTO emprestimos (book_emprestimo, nome_livro, nome_user, data) VALUES (?, ?, ?, NOW())");
            $inserirEmprestimo->execute([$id_livro, $nome_livro, $nome_user]);

            return true;
        }

        return false;
    }

    public function devolverLivro($id) {
        $consultaEmprestimo = $this->pdo->prepare("SELECT livro_Emp, nome_livro, nome_user FROM emprestimos WHERE id = ?");
        $consultaEmprestimo->execute([$id]);
        $emprestimo = $consultaEmprestimo->fetch(PDO::FETCH_ASSOC);

        if ($emprestimo) {
            $id_livro = $emprestimo['livro_emprestimo'];
            $nome_livro = $emprestimo['nome_livro'];
            $nome_user = $emprestimo['nome_user'];

            $consultaLivro = $this->pdo->prepare("SELECT qnt FROM livros WHERE livro_id = ?");
            $consultaLivro->execute([$id_livro]);
            $livro = $consultaLivro->fetch(PDO::FETCH_ASSOC);

            if ($livro) {
                $novaQnt = $livro['qnt'] + 1;
                $this->atualizarQnt($id_livro, $novaQnt);

                $this->registrarHistorico($id, $id_livro, $nome_livro, $nome_user);

                $excluirEmprestimo = $this->pdo->prepare("DELETE FROM emprestimos WHERE id = ?");
                $excluirEmprestimo->execute([$id]);

                return true;
            }
        }

        return false;
    }

    private function atualizarQnt($id_livro, $novaQnt) {
        $atualizarQnt = $this->pdo->prepare("UPDATE livros SET qnt = ? WHERE livro_id = ?");
        $atualizarQnt->execute([$novaQnt, $id_livro]);
    }
    public function listarLivrosEmprestados($nome_user) {
        $consultaLivrosEmprestados = $this->pdo->prepare("SELECT * FROM emprestimos WHERE nome_user = ?");
        $consultaLivrosEmprestados->execute([$nome_user]);
    
        return $consultaLivrosEmprestados->fetchAll(PDO::FETCH_ASSOC);
    }
    private function registrarHistorico($id, $id_livro, $nomeLivro, $nomeUsuario) {
        $inserirHistorico = $this->pdo->prepare("INSERT INTO historico (emprestimo_id, livro_id, nome_livro, nome_aluno) VALUES (?, ?, ?, ?)");
        $inserirHistorico->execute([$id, $id_livro, $nomeLivro, $nomeUsuario]);
        $dataRegistrada = $this->pdo->query("SELECT hora FROM historico WHERE emprestimo_id = $id")->fetchColumn();
    }
    
}
?>


