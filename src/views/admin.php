<?php  require APPROOT . '/views/includes/header.php'; ?>
<h1>Page d'Administration</h1>
<div class="container">
    <button class="btn btn-primary btn-sm" data-type="edit" data-param="new">Ajouter</button>
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Administrateur</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['users'] as $user): ?>
        <tr id="user-<?= $user->getId() ?>">
            <td><?= $user->getId() ?></td>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->isAdmin() ? 'true': 'false' ?></td>
            <td>
                <button class="btn btn-danger btn-sm" data-type="delete" data-param="<?= $user->getId() ?>">Supprimer</button>
                <button class="btn btn-primary btn-sm" data-type="edit" data-param="<?= $user->getId() ?>">Éditer</button>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <?php  require APPROOT . '/views/modals/userModal.php'; ?>

</div>
<?php  require APPROOT . '/views/includes/footer.php'; ?>
