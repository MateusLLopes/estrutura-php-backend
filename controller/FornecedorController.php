<?php
declare(strict_types=1);
require_once '../model/Fornecedor.php';
require_once '../dao/FornecedorDAO.php';

class FornecedorController
{
    private FornecedorDAO $dao;
    public function __construct() { $this->dao = new FornecedorDAO(); }

    private function montar(?int $id = null): Fornecedor
    {
        return (new Fornecedor())
            ->setId($id)
            ->setRazaoSocial(filter_input(INPUT_POST, 'txtrazao_social') ?? '')
            ->setEmail(filter_input(INPUT_POST, 'txtemail') ?? '')
            ->setTelefone(filter_input(INPUT_POST, 'txttelefone') ?? '');
    }

    public function salvar(): bool { return $this->dao->salvar($this->montar()); }
    public function alterar(): bool
    {
        $id = filter_input(INPUT_POST, 'txtid', FILTER_VALIDATE_INT);
        if (!$id) return false;
        return $this->dao->salvar($this->montar($id));
    }
    public function listar(): array { return $this->dao->listar(); }
    public function buscarPorId(int $id): ?Fornecedor { return $this->dao->buscarPorId($id); }
    public function excluir(int $id): bool { return $this->dao->excluir($id); }
}
