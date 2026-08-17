<h3 class="mt-3 text-primary">
    Fornecedores
</h3>

<div class="card shadow mt-3">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3">

        <div class="form-group row">
            <label for="txtnome" class="col-sm-2 col-form-label">
                Nome
            </label>

            <div class="col-sm-10">
                <input
                    type="text"
                    class="form-control"
                    id="txtnome"
                    name="txtnome"
                    placeholder="Nome do fornecedor"
                    value=""
                >
            </div>
        </div>

        <div class="form-group row">
            <label for="txtinformacoes" class="col-sm-2 col-form-label">
                Informações
            </label>

            <div class="col-sm-10">
                <textarea
                    name="txtinformacoes"
                    id="txtinformacoes"
                    rows="3"
                    placeholder="Informações aqui"
                    class="form-control"
                ></textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <div class="col-sm-10">

                <input
                    type="submit"
                    class="btn btn-primary"
                    name="btnsalvar"
                    value="Cadastrar"
                >

                <a href="?p=fornecedores" class="btn btn-danger">
                    Cancelar
                </a>

            </div>
        </div>

    </form>
</div>

<?php

if (filter_input(INPUT_POST, 'btnsalvar')) {

    $nome = filter_input(INPUT_POST, 'txtnome') ?? '';
    $info = filter_input(INPUT_POST, 'txtinformacoes') ?? '';

    require_once __DIR__ . '/../../model/Fornecedor.php';
    require_once __DIR__ . '/../../dao/FornecedorDAO.php';

    $fornecedor = new Fornecedor();

    $fornecedor->setId(null);
    $fornecedor->setNome($nome);
    $fornecedor->setInformacoes($info);

    $fornecedorDAO = new FornecedorDAO();

    if ($fornecedorDAO->salvar($fornecedor)) {
        ?>

        <div class="alert alert-primary mt-3" role="alert">
            Fornecedor - cadastro efetuado com sucesso.
        </div>

        <meta http-equiv="refresh" content="0.2;URL=?p=fornecedores">

        <?php
    } else {
        ?>

        <div class="alert alert-danger mt-3" role="alert">
            Fornecedor - erro ao cadastrar.
        </div>

        <meta http-equiv="refresh" content="0.2;URL=?p=fornecedores">

        <?php
    }
}
?>