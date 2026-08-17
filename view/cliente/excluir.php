<?php

require_once __DIR__ . '/../../model/Cliente.php';
require_once __DIR__ . '/../../dao/ClienteDAO.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    ?>

    <div class="alert alert-danger mt-3" role="alert">
        Cliente inválido.
    </div>

    <?php
    return;
}

$clienteDAO = new ClienteDAO();

if ($clienteDAO->excluir($id)) {
    ?>

    <div class="alert alert-primary mt-3" role="alert">
        Cliente excluído com sucesso.
    </div>

    <meta http-equiv="refresh" content="0.2;URL=?p=clientes">

    <?php
} else {
    ?>

    <div class="alert alert-danger mt-3" role="alert">
        Erro ao excluir cliente.
    </div>

    <meta http-equiv="refresh" content="0.2;URL=?p=clientes">

    <?php
}
?>