<?php

declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Fornecedor.php';

class FornecedorDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = new Conn();
    }

    public function salvar(Fornecedor $fornecedor): bool
    {
        try {
            $sql = "INSERT INTO fornecedor (razao_social, email)
                    VALUES (?, ?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, trim($fornecedor->getRazaoSocial()));
            $stmt->bindValue(2, trim($fornecedor->getEmail()));

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listar(): array
    {
        try {
            $stmt = $this->conn->query(
                "SELECT id, razao_social, email
                   FROM fornecedor
               ORDER BY razao_social ASC"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function excluir(int $id): bool
    {
        try {
            $sql = "DELETE FROM fornecedor WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function pesquisar(string $razaoSocial): array
    {
        $razaoSocial = trim($razaoSocial);

        if ($razaoSocial === '') {
            return [];
        }

        try {
            $sql = "SELECT id, razao_social, email
                      FROM fornecedor
                     WHERE razao_social LIKE :razaoSocial
                  ORDER BY razao_social ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':razaoSocial', '%' . $razaoSocial . '%', PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
