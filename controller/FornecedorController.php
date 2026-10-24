<?php

declare(strict_types=1);

require_once "../model/Fornecedor.php";
require_once "../dao/FornecedorDAO.php";

class FornecedorController
{
    private FornecedorDAO $dao;

    public function __construct()
    {
        $this->dao = new FornecedorDAO();
    }

    public function salvar(): bool
    {
        $fornecedor = new Fornecedor();
        $fornecedor->setRazaoSocial(filter_input(INPUT_POST, 'razaoSocial') ?? '');
        $fornecedor->setEmail(filter_input(INPUT_POST, 'email') ?? '');

        return $this->dao->salvar($fornecedor);
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
