<div class="card shadow mb-4"><div class="table-responsive-sm mt-4">
<h3 class="ml-3">Listar Clientes
<a class="btn btn-success float-right mb-3 mr-3" href="?p=add/cliente"><i class="bi bi-database-fill-add"></i></a></h3>
<table class="table table-striped table-sm"><thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr></thead><tbody>
<?php require_once '../controller/ClienteController.php'; $controller = new ClienteController(); foreach ($controller->listar() as $mostrar): ?>
<tr><td><?= (int)$mostrar['id'] ?></td><td><?= htmlspecialchars($mostrar['nome']) ?></td><td><?= htmlspecialchars($mostrar['email']) ?></td><td><?= htmlspecialchars($mostrar['telefone']) ?></td><td>
<a href="?p=editar/cliente&id=<?= (int)$mostrar['id'] ?>" class="btn btn-warning" title="Editar"><i class="bi bi-pencil-square"></i></a>
<a href="?p=excluir/cliente&id=<?= (int)$mostrar['id'] ?>" class="btn btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="bi bi-x-circle"></i></a>
</td></tr>
<?php endforeach; ?></tbody></table></div></div>
