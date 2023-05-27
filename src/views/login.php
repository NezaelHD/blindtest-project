<?php  require APPROOT . '/views/includes/header.php'; ?>
<h1>Page de login</h1>
<form action="/login" method="post">
    <input type="email" name="email" id="email" placeholder="E-Mail">
    <input type="password" name="password" id="password" placeholder="Mot de passe">
    <input type="submit">
    <?= $data['bad-password'] ?? ''?>
</form>
<a href="/register">J'ai besoin de créer un compte</a>
<?php  require APPROOT . '/views/includes/footer.php'; ?>
