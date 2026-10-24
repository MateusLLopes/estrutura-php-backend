<div class="col-sm-12 mb-4">
    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Pesquisar Cliente
                <a class="btn btn-primary float-right mb-3 mr-3" href="?p=home">
                    <i class="bi bi-house-door"></i>
                </a>
            </h3>

            <form method="post" class="form-inline mb-3 ml-3">
                <label class="mr-2 font-weight-bold" for="nome">Pesquisar cliente:</label>
                <input
                    type="text"
                    id="nome"
                    class="form-control mr-2"
                    name="nome"
                    placeholder="Digite o nome do cliente"
                    value="<?= htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                >
                <input type="submit" class="btn btn-primary" name="enviar" value="PESQUISAR">
            </form>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (filter_input(INPUT_POST, 'enviar')) {
                        $nome = trim((string) (filter_input(INPUT_POST, 'nome') ?? ''));

                        if ($nome === '') {
                            echo "
                                <script>
                                    alert('Digite o nome do cliente para pesquisar.');
                                </script>";
                        } else {
                            require_once "../controller/ClienteController.php";

                            $controller = new ClienteController();
                            $dados = $controller->pesquisar($nome);

                            if ($dados === []) {
                                echo '<tr><td colspan="3" class="text-center">Nenhum cliente encontrado.</td></tr>';
                            } else {
                                foreach ($dados as $mostrar) {
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars((string) ($mostrar['id'] ?? '')) ?></td>
                                        <td><?= htmlspecialchars((string) ($mostrar['nome'] ?? '')) ?></td>
                                        <td><?= htmlspecialchars((string) ($mostrar['email'] ?? '')) ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
