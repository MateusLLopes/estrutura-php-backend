<?php

declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Cliente.php';

class ClienteDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = new Conn();
    }

    public function salvar(Cliente $cliente): bool
    {
        try {
            $sql = "INSERT INTO cliente (nome, email)
                    VALUES (?, ?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, trim($cliente->getNome()));
            $stmt->bindValue(2, trim($cliente->getEmail()));

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listar(): array
    {
        try {
            $stmt = $this->conn->query(
                "SELECT id, nome, email
                   FROM cliente
               ORDER BY nome ASC"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function excluir(int $id): bool
    {
        try {
            $sql = "DELETE FROM cliente WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function pesquisar(string $nome): array
    {
        $nome = trim($nome);

        if ($nome === '') {
            return [];
        }

        try {
            $sql = "SELECT id, nome, email
                      FROM cliente
                     WHERE nome LIKE :nome
                  ORDER BY nome ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', '%' . $nome . '%', PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
