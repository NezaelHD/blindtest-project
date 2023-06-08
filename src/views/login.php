<?php require APPROOT . '/views/includes/header.php'; ?>
<form action="/login" method="post" class="auth__form" autocomplete="off">
    <div class="auth__form_body">
        <h1 class="auth__form_title">Se connecter</h1>
        <div class="form-group">
            <label class="text-uppercase small">E-Mail</label>
            <input type="email" name="email" id="email" placeholder="E-Mail" class="form-control">
        </div>
        <div class="form-group">
            <label class="text-uppercase small">Mot de Passe</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control">
        </div>
        <div class="auth__form_actions">
            <input class="btn" type="submit">
            <?= $data['bad-password'] ?? '' ?>
        </div>
        <a class="link small text-uppercase" href="/register">Je n'ai pas encore de compte</a>
    </div>
</form>

<a href="/register">J'ai besoin de créer un compte</a>
<a class="link small" href="/resetPassword">Réinitialiser mot de passe</a>
<?php  require APPROOT . '/views/includes/footer.php'; ?>
