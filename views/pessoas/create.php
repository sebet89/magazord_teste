<?php include_once __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <h1>Adicionar Pessoa</h1>
   
    <form action="/pessoas/store" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/pessoas" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php include_once __DIR__ . '/../footer.php'; ?>