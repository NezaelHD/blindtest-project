<?php  require APPROOT . '/views/includes/header.php'; ?>
    <form method="post" action="/createNewPassword">
        <h1>Réinitialisez votre mot de passe</h1>
        <input type="hidden" name="selector" value="<?= $data['selector'] ?>">
        <input type="hidden" name="validator" value="<?= $data['validator'] ?>">
        <input type="password" name="pwd" placeholder="Entrez un mot de passe...">
        <input type="password" name="pwd-repeat" placeholder="Confirmer le mot de passe">
        <input type="submit" name="reset-password-submit">
    </form>
<?php  require APPROOT . '/views/includes/footer.php'; ?>