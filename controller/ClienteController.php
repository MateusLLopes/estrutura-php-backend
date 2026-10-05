<?php
declare(strict_types=1);
require_once '../model/Cliente.php';
require_once '../dao/ClienteDAO.php';

class ClienteController
{
    private ClienteDAO $dao;
    public function __construct() { $this->dao = new ClienteDAO(); }

    private function montar(?int $id = null): Cliente
    {
        return (new Cliente())
            ->setId($id)
            ->setNome(filter_input(INPUT_POST, 'txtnome') ?? '')
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
    public function buscarPorId(int $id): ?Cliente { return $this->dao->buscarPorId($id); }
    public function excluir(int $id): bool { return $this->dao->excluir($id); }
}
