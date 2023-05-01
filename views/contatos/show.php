<?php include_once __DIR__ . '/../header.php'; ?>
<div class="container">
    <h1 class="my-3">Detalhes do Contato</h1>
    <dl class="row">
        <dt class="col-sm-3">ID:</dt>
        <dd class="col-sm-9"><?= $contato->getId() ?></dd>
        <dt class="col-sm-3">Tipo:</dt>
        <dd class="col-sm-9"><?= $contato->getTipo() ?></dd>
        <dt class="col-sm-3">Descrição:</dt>
        <dd class="col-sm-9"><?= $contato->getDescricao() ?></dd>
        <dt class="col-sm-3">Pessoa:</dt>
        <dd class="col-sm-9"><?= $contato->getPessoa()->getNome() ?></dd>
    </dl>
    <a href="/contatos" class="btn btn-secondary">Voltar</a>
</div>
<?php include_once __DIR__ . '/../footer.php'; ?>
