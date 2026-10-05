<?php require_once '../controller/ClienteController.php'; if (isset($_POST['btnsalvar'])): $ok = (new ClienteController())->salvar(); ?>
<div class="alert alert-<?= $ok ? 'success' : 'danger' ?>"><?= $ok ? 'Cliente cadastrado com sucesso!' : 'Erro ao cadastrar cliente.' ?></div>
<?php if ($ok): ?><script>setTimeout(() => window.location.href='?p=clientes', 1200);</script><?php endif; ?><?php endif; ?>
<div class="card"><div class="card-header">Novo Cliente</div><div class="card-body"><form method="post">
<div class="mb-3"><label>Nome</label><input type="text" name="txtnome" class="form-control" required></div>
<div class="mb-3"><label>E-mail</label><input type="email" name="txtemail" class="form-control" required></div>
<div class="mb-3"><label>Telefone</label><input type="text" name="txttelefone" class="form-control" required></div>
<button type="submit" name="btnsalvar" class="btn btn-success">Salvar</button> <a href="?p=clientes" class="btn btn-secondary">Cancelar</a>
</form></div></div>
