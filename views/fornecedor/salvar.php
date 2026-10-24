<div class="col-sm-12 mb-4">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="mb-4">Cadastrar Fornecedor</h3>

            <?php
            require_once '../controller/FornecedorController.php';

            if (filter_input(INPUT_POST, 'enviar')) {
                $controller = new FornecedorController();

                if ($controller->salvar()) {
                    echo '<div class="alert alert-success">Fornecedor cadastrado com sucesso!</div>';
                    echo '<meta http-equiv="refresh" content="1;URL=?p=pesquisar/fornecedor">';
                } else {
                    echo '<div class="alert alert-danger">Erro ao cadastrar fornecedor.</div>';
                }
            }
            ?>

            <form method="post">
                <div class="form-group">
                    <label for="razaoSocial">Razão Social</label>
                    <input type="text" class="form-control" id="razaoSocial" name="razaoSocial" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary" name="enviar" value="1">Salvar</button>
                <a href="?p=pesquisar/fornecedor" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
