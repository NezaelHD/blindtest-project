<?php  require APPROOT . '/views/includes/header.php'; ?>
<h1>Profil de <?= $data['user']['name']; ?></h1>

<form action="/profil" method="post">
    <ul class="list-unstyled">
        <input type="hidden" name="id" value="<?= $data['user']['id']; ?>"> <!-- Champ hidden pour l'ID -->
        <li><strong>Email:</strong><br><input type="text" name="email" value="<?= $data['user']['email']; ?>" required></li>
        <li><strong>Nom:</strong><br><input type="text" name="name" value="<?= $data['user']['name']; ?>" required></li>
        <li><strong>Mot de passe:</strong><br><input type="password" name="password" value="<?= $data['user']['password']; ?>" required></li>
        <li><strong>Avatar:</strong><br>[Aucun avatar]</li>
    </ul>

    <button type="submit">Modifier</button>
</form>

<?php  require APPROOT . '/views/includes/footer.php'; ?>
