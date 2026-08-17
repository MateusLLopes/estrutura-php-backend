<?php

declare(strict_types=1);

require_once __DIR__ . '/../model/Conn.php';
require_once __DIR__ . '/../model/Fornecedor.php';

class FornecedorDAO
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Conn::getInstance();
    }

    public function texto(): string
    {
        return "SELECT * FROM fornecedor";
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM fornecedor WHERE id = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * @return Fornecedor[]
     */
    public function listar(): array
    {
        $sql = $this->texto();

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $fornecedores = [];

        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $fornecedor = new Fornecedor();

            $fornecedor->setId((int) $registro["id"]);
            $fornecedor->setNome($registro["nome"]);
            $fornecedor->setInformacoes($registro["informacoes"]);

            $fornecedores[] = $fornecedor;
        }

        return $fornecedores;
    }

    public function consultarPorID(int $id): ?Fornecedor
    {
        $sql = "SELECT * FROM fornecedor WHERE id = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $registro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$registro) {
            return null;
        }

        $fornecedor = new Fornecedor();

        $fornecedor->setId((int) $registro["id"]);
        $fornecedor->setNome($registro["nome"]);
        $fornecedor->setInformacoes($registro["informacoes"]);

        return $fornecedor;
    }

    public function salvar(Fornecedor $fornecedor): bool
    {
        // INSERT
        if ($fornecedor->getId() === null) {
            $sql = "
                INSERT INTO fornecedor
                (nome, informacoes)
                VALUES
                (:nome, :informacoes)
            ";

            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(":nome", $fornecedor->getNome());
            $stmt->bindValue(
                ":informacoes",
                $fornecedor->getInformacoes()
            );

            $resultado = $stmt->execute();

            if ($resultado) {
                $fornecedor->setId(
                    (int) $this->conexao->lastInsertId()
                );
            }

            return $resultado;
        }

        // UPDATE
        $sql = "
            UPDATE fornecedor SET
                nome = :nome,
                informacoes = :informacoes
            WHERE id = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(
            ":id",
            $fornecedor->getId(),
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ":nome",
            $fornecedor->getNome()
        );

        $stmt->bindValue(
            ":informacoes",
            $fornecedor->getInformacoes()
        );

        return $stmt->execute();
    }
}