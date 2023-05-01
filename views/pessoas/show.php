<?php include_once __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <h1>Detalhes da Pessoa</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td><?= $pessoa->getId() ?></td>
        </tr>
        <tr>
            <th>Nome</th>
            <td><?= $pessoa->getNome() ?></td>
        </tr>
        <tr>
            <th>CPF</th>
            <td><?= $pessoa->getCpf() ?></td>
        </tr>
    </table>
    <a href="/pessoas" class="btn btn-secondary">Voltar</a>
</div>

<?php include_once __DIR__ . '/../footer.php'; ?>