<?php require APPROOT . '/views/includes/header.php'; ?>
    <form method="post" action="/resetPassword">
        <h1>Réinitialisation Mot de passe</h1>
        <p>Entrez votre adresse e-mail pour recevoir le lien de réinitialisation</p>
        <input type="text" name="email">
        <input type="submit" name="reset-request-submit">
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