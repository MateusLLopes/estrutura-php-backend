<div class="col-sm-12 mb-4">

    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Listar Fornecedores
                <a class="btn btn-success float-right mb-3 mr-3" href="?p=add/fornecedor"><i class="bi bi-building-add"></i></a>
            </h3>

            <form method="post" class="form-inline mb-3 ml-3">
                <input type="text" class="form-control mr-2" name="razaoSocial" placeholder="Pesquisar fornecedor">
                <input type="submit" class="btn btn-primary" name="enviar" value="Pesquisar">
            </form>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Razão Social</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    require_once '../controller/FornecedorController.php';

                    $controller = new FornecedorController();

                    if (filter_input(INPUT_POST, 'enviar')) {
                        $razaoSocial = trim((string) (filter_input(INPUT_POST, 'razaoSocial') ?? ''));
                        $dados = $razaoSocial === '' ? $controller->listar() : $controller->pesquisar($razaoSocial);
                    } else {
                        $dados = $controller->listar();
                    }

                    foreach ($dados as $mostrar) {
                    ?>
                        <tr>
                            <td><?= htmlspecialchars((string) ($mostrar['id'] ?? '')) ?></td>
                            <td><?= htmlspecialchars((string) ($mostrar['razao_social'] ?? '')) ?></td>
                            <td><?= htmlspecialchars((string) ($mostrar['email'] ?? '')) ?></td>
                            <td>
                                <a href="?p=excluir/fornecedor&id=<?= (int) ($mostrar['id'] ?? 0) ?>"
                                    class="btn btn-danger"
                                    title="Excluir"
                                    onclick="return confirm('Tem certeza que deseja excluir?')">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
