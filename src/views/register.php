<?php  require APPROOT . '/views/includes/header.php'; ?>
<h1>Page d'inscription</h1>
<form action="/register" method="post">
    <input type="text" name="name" id="name" placeholder="Nom">
    <?= $data['email'] ?? "" ?>
    <input type="email" name="email" id="email" placeholder="E-Mail">
    <?= $data['password'] ?? "" ?>
    <input type="password" name="password" id="password" placeholder="Mot de passe">
    <?= $data['confirm-password'] ?? "" ?>
    <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmation du mot de passe">
    <input type="submit">
</form>
<a href="/login">J'ai déjà un compte</a>
<?php  require APPROOT . '/views/includes/footer.php'; ?>
