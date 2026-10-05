<?php
declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Fornecedor.php';

class FornecedorDAO
{
    private PDO $conn;
    public function __construct() { $this->conn = new Conn(); }

    public function salvar(Fornecedor $fornecedor): bool
    {
        if ($fornecedor->getId() === null) {
            $stmt = $this->conn->prepare('INSERT INTO fornecedor (razao_social, email, telefone) VALUES (?, ?, ?)');
            $stmt->bindValue(1, $fornecedor->getRazaoSocial());
            $stmt->bindValue(2, $fornecedor->getEmail());
            $stmt->bindValue(3, $fornecedor->getTelefone());
        } else {
            $stmt = $this->conn->prepare('UPDATE fornecedor SET razao_social = ?, email = ?, telefone = ? WHERE id = ?');
            $stmt->bindValue(1, $fornecedor->getRazaoSocial());
            $stmt->bindValue(2, $fornecedor->getEmail());
            $stmt->bindValue(3, $fornecedor->getTelefone());
            $stmt->bindValue(4, $fornecedor->getId(), PDO::PARAM_INT);
        }
        return $stmt->execute();
    }

    public function listar(): array
    {
        return $this->conn->query('SELECT * FROM fornecedor ORDER BY razao_social')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?Fornecedor
    {
        $stmt = $this->conn->prepare('SELECT * FROM fornecedor WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$dados) return null;
        return (new Fornecedor())->setId((int)$dados['id'])->setRazaoSocial($dados['razao_social'])->setEmail($dados['email'])->setTelefone($dados['telefone']);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->conn->prepare('DELETE FROM fornecedor WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
