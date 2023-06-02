<?php  require APPROOT . '/views/includes/header.php'; ?>
<div class="container">
    <h2>Page d'Administration</h2>
    <button class="btn btn-primary btn-sm user-modal" data-type="edit" data-param="new">Ajouter</button>
    <table class="table table-striped table-responsive user-table">
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
                <button class="btn btn-danger btn-sm user-modal" data-type="delete" data-param="<?= $user->getId() ?>">Supprimer</button>
                <button class="btn btn-primary btn-sm user-modal" data-type="edit" data-param="<?= $user->getId() ?>">Éditer</button>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <?php  require APPROOT . '/views/modals/userModal.php'; ?>

    <h2>Gestion des Blindtests</h2>
    <button class="btn btn-primary btn-sm blind-test-modal" data-type="edit" data-param="new">Ajouter</button>
    <table class="table table-striped table-responsive blindtest-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Auteur</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['blindtests'] as $blindtest): ?>
            <tr id="blindtest-<?= $blindtest->getId() ?>">
                <td><?= $blindtest->getId() ?></td>
                <td><?= $blindtest->getName() ?></td>
                <td><?= $blindtest->getAuthor() ?></td>
                <td><?= $blindtest->getDescription() ?></td>
                <td>
                    <button class="btn btn-danger btn-sm blind-test-modal" data-type="delete" data-param="<?= $blindtest->getId() ?>">Supprimer</button>
                    <button class="btn btn-primary btn-sm blind-test-modal" data-type="edit" data-param="<?= $blindtest->getId() ?>">Éditer</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php require APPROOT . '/views/modals/blindtestModal.php'; ?>

</div>
<?php  require APPROOT . '/views/includes/footer.php'; ?>
