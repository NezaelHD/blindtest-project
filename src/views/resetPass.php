<?php require APPROOT . '/views/includes/header.php'; ?>
    <form class="auth__form" method="post" action="/resetPassword" autocomplete="off">
        <div class="auth__form_body">
            <h1 class="auth__form_title">Réinitialisation Mot de passe</h1>
            <div class="form-group">
                <p>Entrez votre adresse e-mail pour recevoir le lien de réinitialisation</p>
                <input class="form-control" type="text" name="email">
            </div>
            <div class="auth__form_actions">
                <input class="btn" type="submit" name="reset-request-submit">
            </div>
        </div>
    </form>
<?php
if ($data) {
    if ($data['isSuccess']) {
        echo '<p class="resetsuccess">Vérifiez vos emails !</p>';
    } else if (!$data['isSuccess']) {
        echo '<p class="resetfail">L\'email n\'a pas pu être envoyé...</p>';
    }
}
?>
<?php require APPROOT . '/views/includes/footer.php'; ?>