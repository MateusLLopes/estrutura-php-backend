<?php

require_once __DIR__ . '/../../model/Fornecedor.php';
require_once __DIR__ . '/../../dao/FornecedorDAO.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    ?>

    <div class="alert alert-danger mt-3" role="alert">
        Fornecedor inválido.
    </div>

    <?php
    return;
}

$fornecedorDAO = new FornecedorDAO();

if ($fornecedorDAO->excluir($id)) {
    ?>

    <div class="alert alert-primary mt-3" role="alert">
        Fornecedor excluído com sucesso.
    </div>

    <meta http-equiv="refresh" content="0.2;URL=?p=fornecedores">

    <?php
} else {
    ?>

    <div class="alert alert-danger mt-3" role="alert">
        Erro ao excluir fornecedor.
    </div>

    <meta http-equiv="refresh" content="0.2;URL=?p=fornecedores">

    <?php
}
?>