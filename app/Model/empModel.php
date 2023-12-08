<?php

class EmpModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function empLivro($id_livro, $nome_livro, $nome_user) {
        $consultaLivro = $this->pdo->prepare("SELECT qnt FROM livros WHERE id_livro = ?");
        $consultaLivro->execute([$id_livro]);
        $book = $consultaLivro->fetch(PDO::FETCH_ASSOC);

        if ($book && $book['qnt'] > 0) {
            $novaQnt = $book['qnt'] - 1;
            $this->atualizarqnt($id_livro, $novaQnt);

            $inserirEmprestimo = $this->pdo->prepare("INSERT INTO emprestimos (id_livro, nome_livro, nome_user, data) VALUES (?, ?, ?, NOW())");
            $inserirEmprestimo->execute([$id_livro, $nome_livro, $nome_user]);

            return true;
        }

        return false;
    }

    public function devolverLivro($id_emprestimo) {
        $consultaEmprestimo = $this->pdo->prepare("SELECT id_livro, nome_livro, nome_user FROM emprestimos WHERE id_emp = ?");
        $consultaEmprestimo->execute([$id_emprestimo]);
        $emprestimo = $consultaEmprestimo->fetch(PDO::FETCH_ASSOC);

        if ($emprestimo) {
            $id_livro = $emprestimo['id_livro'];
            $nome_livro = $emprestimo['nome_livro'];
            $nome_user = $emprestimo['nome_user'];

            $consultaLivro = $this->pdo->prepare("SELECT qnt FROM livros WHERE id_livro = ?");
            $consultaLivro->execute([$id_livro]);
            $livro = $consultaLivro->fetch(PDO::FETCH_ASSOC);

            if ($livro) {
                $novaQnt = $livro['qnt'] + 1;
                $this->atualizarQnt($id_livro, $novaQnt);

                $this->registrarHistorico($id_emprestimo, $id_livro, $nome_livro, $nome_user);

                $excluirEmprestimo = $this->pdo->prepare("DELETE FROM emprestimos WHERE id_emp = ?");
                $excluirEmprestimo->execute([$id_emprestimo]);

                return true;
            }
        }

        return false;
    }

    private function atualizarQnt($id_livro, $novaQnt) {
        $atualizarQnt = $this->pdo->prepare("UPDATE livros SET qnt = ? WHERE id_livro = ?");
        $atualizarQnt->execute([$novaQnt, $id_livro]);
    }
    public function listarLivrosEmprestados($nome_user) {
        $consultaLivrosEmprestados = $this->pdo->prepare("SELECT * FROM emprestimos WHERE nome_user = ?");
        $consultaLivrosEmprestados->execute([$nome_user]);
    
        return $consultaLivrosEmprestados->fetchAll(PDO::FETCH_ASSOC);
    }
    private function registrarHistorico($id_emp, $id_livro, $nomeLivro, $nomeUsuario) {
        $inserirHistorico = $this->pdo->prepare("INSERT INTO historico (id_emp, id_livro, nome_livro, nome_user) VALUES (?, ?, ?, ?)");
        $inserirHistorico->execute([$id_emp, $id_livro, $nomeLivro, $nomeUsuario]);
        $dataRegistrada = $this->pdo->query("SELECT hora FROM historico WHERE id_emp = $id_emp")->fetchColumn();
    }

    public function listarHistorico() {
        $sql = "SELECT * FROM historico";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>


