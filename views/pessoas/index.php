<?php include_once __DIR__ . '/../header.php'; ?>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css"/>

<div class="container mt-5">
    <h1>Pessoas</h1>
    <a href="/pessoas/create" class="btn btn-primary mb-3">Adicionar Pessoa</a>
    <table class="table" id="pessoas-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pessoas as $pessoa): ?>
                <tr>
                    <td><?= $pessoa->getId() ?></td>
                    <td><?= $pessoa->getNome() ?></td>
                    <td><?= $pessoa->getCpf() ?></td>
                    <td>
                        <a href="/pessoas/<?= $pessoa->getId() ?>" class="btn btn-sm btn-info">Visualizar</a>
                        <a href="/pessoas/<?= $pessoa->getId() ?>/edit" class="btn btn-sm btn-warning">Editar</a>
                        <form action="/pessoas/<?= $pessoa->getId() ?>/delete" method="POST" style="display:inline;">
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
                { targets: [3], orderable: false, searchable: false }
            ]
        });
    });
</script>

<?php include_once __DIR__ . '/../footer.php'; ?>
