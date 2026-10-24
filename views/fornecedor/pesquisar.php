<div class="col-sm-12 mb-4">
    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Pesquisar Fornecedor
                <a class="btn btn-primary float-right mb-3 mr-3" href="?p=home">
                    <i class="bi bi-house-door"></i>
                </a>
            </h3>

            <form method="post" class="form-inline mb-3 ml-3">
                <label class="mr-2 font-weight-bold" for="razaoSocial">Pesquisar fornecedor:</label>
                <input
                    type="text"
                    id="razaoSocial"
                    class="form-control mr-2"
                    name="razaoSocial"
                    placeholder="Digite a razão social"
                    value="<?= htmlspecialchars($_POST['razaoSocial'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                >
                <input type="submit" class="btn btn-primary" name="enviar" value="PESQUISAR">
            </form>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Razão Social</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (filter_input(INPUT_POST, 'enviar')) {
                        $razaoSocial = trim((string) (filter_input(INPUT_POST, 'razaoSocial') ?? ''));

                        if ($razaoSocial === '') {
                            echo "
                                <script>
                                    alert('Digite a razão social para pesquisar.');
                                </script>";
                        } else {
                            require_once "../controller/FornecedorController.php";

                            $controller = new FornecedorController();
                            $dados = $controller->pesquisar($razaoSocial);

                            if ($dados === []) {
                                echo '<tr><td colspan="3" class="text-center">Nenhum fornecedor encontrado.</td></tr>';
                            } else {
                                foreach ($dados as $mostrar) {
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars((string) ($mostrar['id'] ?? '')) ?></td>
                                        <td><?= htmlspecialchars((string) ($mostrar['razao_social'] ?? '')) ?></td>
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
