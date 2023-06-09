<?php require APPROOT . '/views/includes/header.php'; ?>
    <form class="auth__form" autocomplete="off" method="post" action="/createNewPassword">
        <div class="auth__form_body">
            <h1 class="auth__form_title">Réinitialisez votre mot de passe</h1>
            <input type="hidden" name="selector" value="<?= $data['selector'] ?>">
            <input type="hidden" name="validator" value="<?= $data['validator'] ?>">
            <div class="form-group">
                <input class="form-control" type="password" name="pwd" placeholder="Entrez un mot de passe...">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="pwd-repeat" placeholder="Confirmer le mot de passe">
            </div>
            <div class="auth__form_actions">
                <input class="btn" type="submit" name="reset-password-submit">
            </div>
        </div>
    </form>
<?php require APPROOT . '/views/includes/footer.php'; ?>