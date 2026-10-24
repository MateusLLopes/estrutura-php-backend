<?php

declare(strict_types=1);

require_once "../model/Cliente.php";
require_once "../dao/ClienteDAO.php";

class ClienteController
{
    private ClienteDAO $dao;

    public function __construct()
    {
        $this->dao = new ClienteDAO();
    }

    public function salvar(): bool
    {
        $cliente = new Cliente();
        $cliente->setNome(filter_input(INPUT_POST, 'nome') ?? '');
        $cliente->setEmail(filter_input(INPUT_POST, 'email') ?? '');

        return $this->dao->salvar($cliente);
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function excluir(int $id): bool
    {
        return $this->dao->excluir($id);
    }

    public function pesquisar(string $valor): array
    {
        return $this->dao->pesquisar($valor);
    }
}
