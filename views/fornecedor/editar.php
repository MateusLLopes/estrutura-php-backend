<?php
require_once '../controller/FornecedorController.php';
$controller = new FornecedorController();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { echo '<div class="alert alert-danger">ID não informado.</div>'; exit; }
$fornecedor = $controller->buscarPorId($id);
if (!$fornecedor) { echo '<div class="alert alert-danger">Fornecedor não encontrado.</div>'; exit; }
if (isset($_POST['btnalterar'])) {
    $ok = $controller->alterar();
    echo '<div class="alert alert-'.($ok?'success':'danger').'">'.($ok?'Fornecedor alterado com sucesso!':'Erro ao alterar fornecedor.').'</div>';
    if ($ok) { echo '<script>setTimeout(() => window.location.href="?p=fornecedores", 1200);</script>'; }
    else { $fornecedor = $controller->buscarPorId($id); }
}
?>
<div class="card"><div class="card-header">Editar Fornecedor</div><div class="card-body"><form method="post">
<input type="hidden" name="txtid" value="<?= $fornecedor->getId() ?>">
<div class="mb-3"><label>Razão Social</label><input type="text" name="txtrazao_social" class="form-control" value="<?= htmlspecialchars($fornecedor->getRazaoSocial()) ?>" required></div>
<div class="mb-3"><label>E-mail</label><input type="email" name="txtemail" class="form-control" value="<?= htmlspecialchars($fornecedor->getEmail()) ?>" required></div>
<div class="mb-3"><label>Telefone</label><input type="text" name="txttelefone" class="form-control" value="<?= htmlspecialchars($fornecedor->getTelefone()) ?>" required></div>
<button type="submit" name="btnalterar" class="btn btn-primary">Atualizar</button> <a href="?p=fornecedores" class="btn btn-secondary">Cancelar</a>
</form></div></div>
