<div class="col-sm-12 mb-4">

    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Listar Clientes
                <a class="btn btn-success float-right mb-3 mr-3" href="?p=add/cliente"><i class="bi bi-person-plus"></i></a>
            </h3>

            <form method="post" class="form-inline mb-3 ml-3">
                <input type="text" class="form-control mr-2" name="nome" placeholder="Pesquisar cliente">
                <input type="submit" class="btn btn-primary" name="enviar" value="Pesquisar">
            </form>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    require_once '../controller/ClienteController.php';

                    $controller = new ClienteController();

                    if (filter_input(INPUT_POST, 'enviar')) {
                        $nome = trim((string) (filter_input(INPUT_POST, 'nome') ?? ''));
                        $dados = $nome === '' ? $controller->listar() : $controller->pesquisar($nome);
                    } else {
                        $dados = $controller->listar();
                    }

                    foreach ($dados as $mostrar) {
                    ?>
                        <tr>
                            <td><?= htmlspecialchars((string) ($mostrar['id'] ?? '')) ?></td>
                            <td><?= htmlspecialchars((string) ($mostrar['nome'] ?? '')) ?></td>
                            <td><?= htmlspecialchars((string) ($mostrar['email'] ?? '')) ?></td>
                            <td>
                                <a href="?p=excluir/cliente&id=<?= (int) ($mostrar['id'] ?? 0) ?>"
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
