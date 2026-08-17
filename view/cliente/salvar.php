<h3 class="mt-3 text-primary">
    Clientes
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
                    placeholder="Nome do cliente"
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

                <a href="?p=clientes" class="btn btn-danger">
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

    require_once __DIR__ . '/../../model/Cliente.php';
    require_once __DIR__ . '/../../dao/ClienteDAO.php';

    $cliente = new Cliente();

    $cliente->setId(null);
    $cliente->setNome($nome);
    $cliente->setInformacoes($info);

    $clienteDAO = new ClienteDAO();

    if ($clienteDAO->salvar($cliente)) {
        ?>

        <div class="alert alert-primary mt-3" role="alert">
            Cliente - cadastro efetuado com sucesso.
        </div>

        <meta http-equiv="refresh" content="0.2;URL=?p=clientes">

        <?php
    } else {
        ?>

        <div class="alert alert-danger mt-3" role="alert">
            Cliente - erro ao cadastrar.
        </div>

        <meta http-equiv="refresh" content="0.2;URL=?p=clientes">

        <?php
    }
}
?>