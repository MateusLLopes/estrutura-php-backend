<?php require_once '../controller/FornecedorController.php'; if (isset($_POST['btnsalvar'])): $ok = (new FornecedorController())->salvar(); ?>
<div class="alert alert-<?= $ok ? 'success' : 'danger' ?>"><?= $ok ? 'Fornecedor cadastrado com sucesso!' : 'Erro ao cadastrar fornecedor.' ?></div>
<?php if ($ok): ?><script>setTimeout(() => window.location.href='?p=fornecedores', 1200);</script><?php endif; ?><?php endif; ?>
<div class="card"><div class="card-header">Novo Fornecedor</div><div class="card-body"><form method="post">
<div class="mb-3"><label>Razão Social</label><input type="text" name="txtrazao_social" class="form-control" required></div>
<div class="mb-3"><label>E-mail</label><input type="email" name="txtemail" class="form-control" required></div>
<div class="mb-3"><label>Telefone</label><input type="text" name="txttelefone" class="form-control" required></div>
<button type="submit" name="btnsalvar" class="btn btn-success">Salvar</button> <a href="?p=fornecedores" class="btn btn-secondary">Cancelar</a>
</form></div></div>
