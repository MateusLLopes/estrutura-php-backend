<div class="col-sm-12 mb-4">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="mb-4">Cadastrar Cliente</h3>

            <?php
            require_once '../controller/ClienteController.php';

            if (filter_input(INPUT_POST, 'enviar')) {
                $controller = new ClienteController();

                if ($controller->salvar()) {
                    echo '<div class="alert alert-success">Cliente cadastrado com sucesso!</div>';
                    echo '<meta http-equiv="refresh" content="1;URL=?p=pesquisar/cliente">';
                } else {
                    echo '<div class="alert alert-danger">Erro ao cadastrar cliente.</div>';
                }
            }
            ?>

            <form method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary" name="enviar" value="1">Salvar</button>
                <a href="?p=pesquisar/cliente" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
