<?php include_once __DIR__ . '/../header.php'; ?>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css"/>

<div class="container">
    <h1 class="my-3">Contatos</h1>
    <a href="/contatos/create" class="btn btn-primary mb-3">Adicionar Contato</a>
    <table class="table table-bordered" id="contatos-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Pessoa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contatos as $contato): ?>
            <tr>
                <td><?= $contato->getId() ?></td>
                <td><?= $contato->getTipo() ?></td>
                <td><?= $contato->getDescricao() ?></td>
                <td><?= $contato->getPessoa()->getNome() ?></td>
                <td>
                    <a href="/contatos/<?= $contato->getId() ?>" class="btn btn-sm btn-info">Visualizar</a>
                    <a href="/contatos/<?= $contato->getId() ?>/edit" class="btn btn-sm btn-warning">Editar</a>
                    <form action="/contatos/<?= $contato->getId() ?>/delete" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- jQuery, DataTables JS and initialization -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            columnDefs: [
                { targets: [4], orderable: false, searchable: false }
            ]
        });
    });
</script>

<?php include_once __DIR__ . '/../footer.php'; ?>