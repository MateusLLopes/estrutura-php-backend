<?php

declare(strict_types=1);

require_once __DIR__ . '/../model/Conn.php';
require_once __DIR__ . '/../model/Cliente.php';

class ClienteDAO
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Conn::getInstance();
    }

    public function texto(): string
    {
        return "SELECT * FROM cliente";
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM cliente WHERE id = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * @return Cliente[]
     */
    public function listar(): array
    {
        $sql = $this->texto();

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $clientes = [];

        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cliente = new Cliente();

            $cliente->setId((int) $registro["id"]);
            $cliente->setNome($registro["nome"]);
            $cliente->setInformacoes($registro["informacoes"]);

            $clientes[] = $cliente;
        }

        return $clientes;
    }

    public function consultarPorID(int $id): ?Cliente
    {
        $sql = "SELECT * FROM cliente WHERE id = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $registro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$registro) {
            return null;
        }

        $cliente = new Cliente();

        $cliente->setId((int) $registro["id"]);
        $cliente->setNome($registro["nome"]);
        $cliente->setInformacoes($registro["informacoes"]);

        return $cliente;
    }

    public function salvar(Cliente $cliente): bool
    {
        // INSERT
        if ($cliente->getId() === null) {
            $sql = "
                INSERT INTO cliente
                (nome, informacoes)
                VALUES
                (:nome, :informacoes)
            ";

            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(":nome", $cliente->getNome());
            $stmt->bindValue(":informacoes", $cliente->getInformacoes());

            $resultado = $stmt->execute();

            if ($resultado) {
                $cliente->setId(
                    (int) $this->conexao->lastInsertId()
                );
            }

            return $resultado;
        }

        // UPDATE
        $sql = "
            UPDATE cliente SET
                nome = :nome,
                informacoes = :informacoes
            WHERE id = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(
            ":id",
            $cliente->getId(),
            PDO::PARAM_INT
        );

        $stmt->bindValue(":nome", $cliente->getNome());
        $stmt->bindValue(
            ":informacoes",
            $cliente->getInformacoes()
        );

        return $stmt->execute();
    }
}