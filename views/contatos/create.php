<?php include_once __DIR__ . '/../header.php'; ?>
    <div class="container">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <h1 class="my-3">Adicionar Contato</h1>
        <form action="/contatos/store" method="POST">
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="Telefone">Telefone</option>
                    <option value="Email">Email</option>
                </select>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" name="descricao" id="descricao" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pessoa_id">Pessoa:</label>
                <select name="pessoa_id" id="pessoa_id" class="form-control">
                    <?php foreach ($pessoas as $pessoa) : ?>
                        <option value="<?= $pessoa->getId() ?>"><?= $pessoa->getNome() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/contatos" class="btn.btn-secondary">Voltar</a>
        </form>
    </div>
    <?php include_once __DIR__ . '/../footer.php'; ?>
