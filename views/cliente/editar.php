<?php
require_once '../controller/ClienteController.php';
$controller = new ClienteController();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { echo '<div class="alert alert-danger">ID não informado.</div>'; exit; }
$cliente = $controller->buscarPorId($id);
if (!$cliente) { echo '<div class="alert alert-danger">Cliente não encontrado.</div>'; exit; }
if (isset($_POST['btnalterar'])) {
    $ok = $controller->alterar();
    echo '<div class="alert alert-'.($ok?'success':'danger').'">'.($ok?'Cliente alterado com sucesso!':'Erro ao alterar cliente.').'</div>';
    if ($ok) { echo '<script>setTimeout(() => window.location.href="?p=clientes", 1200);</script>'; }
    else { $cliente = $controller->buscarPorId($id); }
}
?>
<div class="card"><div class="card-header">Editar Cliente</div><div class="card-body"><form method="post">
<input type="hidden" name="txtid" value="<?= $cliente->getId() ?>">
<div class="mb-3"><label>Nome</label><input type="text" name="txtnome" class="form-control" value="<?= htmlspecialchars($cliente->getNome()) ?>" required></div>
<div class="mb-3"><label>E-mail</label><input type="email" name="txtemail" class="form-control" value="<?= htmlspecialchars($cliente->getEmail()) ?>" required></div>
<div class="mb-3"><label>Telefone</label><input type="text" name="txttelefone" class="form-control" value="<?= htmlspecialchars($cliente->getTelefone()) ?>" required></div>
<button type="submit" name="btnalterar" class="btn btn-primary">Atualizar</button> <a href="?p=clientes" class="btn btn-secondary">Cancelar</a>
</form></div></div>
