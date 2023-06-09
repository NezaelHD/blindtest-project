<?php require APPROOT . '/views/includes/header.php'; ?>
<div class="header_offset"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="auth__form_title">Profil de <?= $data['user']['name']; ?></h1>
            <form action="/profil" method="post" class="Large__Form" autocomplete="off">
                <div class="auth__form_body">
                    <input type="hidden" name="id" value="<?= $data['user']['id']; ?>">
                    <div class="form-group mb-4">
                        <label class="text-uppercase small custom-label">Nom</label>
                        <input type="text" name="name" id="name" value="<?= $data['user']['name']; ?>" required
                               class="Large__Input">
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-uppercase small custom-label">E-Mail</label>
                        <input type="email" name="email" id="email" value="<?= $data['user']['email']; ?>" required
                               class="Large__Input">
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-uppercase small custom-label">Mot de Passe</label>
                        <input type="password" name="password" id="password" value="<?= $data['user']['password']; ?>"
                               required class="Large__Input">
                    </div>
                    <div class="auth__form_actions">
                        <input class="btn btn-primary" type="submit" value="Modifier">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="table-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Gestion des Blindtests</h2>
                <button class="btn btn-primary btn-sm blind-test-modal" data-type="edit" data-param="new">Ajouter
                </button>
                <table class="table table-dark table-responsive blindtest-table">
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
                        <?php if ($blindtest->getAuthor() === $data['user']['id']): ?>
                            <tr id="blindtest-<?= $blindtest->getId() ?>">
                                <td><?= $blindtest->getId() ?></td>
                                <td><?= $blindtest->getName() ?></td>
                                <td><?= $blindtest->getAuthor() ?></td>
                                <td><?= $blindtest->getDescription() ?></td>
                                <td>
                                    <button class="btn-danger btn-sm blind-test-modal" data-type="delete"
                                            data-param="<?= $blindtest->getId() ?>">Supprimer
                                    </button>
                                    <button class="btn-primary btn-sm blind-test-modal" data-type="edit"
                                            data-param="<?= $blindtest->getId() ?>">Éditer
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php require APPROOT . '/views/modals/blindtestModal.php'; ?>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/footer.php'; ?>
