<div class="col-sm-12 mb-4">

    <div class="card shadow mb-4">

        <div class="table-responsive-sm mt-4">

            <h3 class="ml-3">
                Listar Fornecedores

                <a
                    class="btn btn-success float-right mb-3 mr-3"
                    href="?p=add/fornecedor"
                >
                    <i class="bi bi-database-fill-add"></i>
                </a>
            </h3>

            <table class="table table-striped table-sm">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Informações</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    require_once __DIR__ . "/../../model/Fornecedor.php";
                    require_once __DIR__ . "/../../dao/FornecedorDAO.php";

                    $fornecedorDAO = new FornecedorDAO();

                    $dados = $fornecedorDAO->listar();

                    foreach ($dados as $mostrar) {
                    ?>

                        <tr>

                            <td>
                                <?= $mostrar->getId() ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($mostrar->getNome()) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($mostrar->getInformacoes()) ?>
                            </td>

                            <td>

                                <a
                                    href="?p=excluir/fornecedor&id=<?= $mostrar->getId() ?>"
                                    class="btn btn-danger"
                                    title="Excluir"
                                    onclick="return confirm('Tem certeza que deseja excluir?')"
                                >
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