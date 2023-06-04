<?php require APPROOT . '/views/includes/header.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand logo" href=""><img src="../../public/assets/img/logo.png" alt="logo"></a>
    <p class="navbar-text">Are You Blinded?</p>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link btn" href="register">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn" href="login">Login</a>
            </li>
        </ul>
    </div>
</nav>
<form action="/register" method="post" class="auth__form" autocomplete="off">
    <div class="auth__form_body">
        <h1 class="auth__form_title">Inscription</h1>
        <div class="form-group">
            <label class="text-uppercase small">Nom</label>
            <input type="text" name="name" id="name" placeholder="Nom" class="form-control">
        </div>
        <div class="form-group">
            <label class="text-uppercase small">Email</label>
            <?= $data['email'] ?? "" ?>
            <input type="email" name="email" id="email" placeholder="E-Mail" class="form-control">
        </div>
        <div class="form-group">
            <label class="text-uppercase small">Mot de Passe</label>
            <?= $data['password'] ?? "" ?>
            <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control">
        </div>
        <div class="form-group">
            <label class="text-uppercase small">Confirmer Mot de Passe</label>
            <?= $data['confirm-password'] ?? "" ?>
            <input type="password" name="confirm-password" id="confirm-password"
                   placeholder="Confirmation du mot de passe" class="form-control">
        </div>
        <div class="auth__form_actions">
            <input class="btn" type="submit">
        </div>
        <a class="link small text-uppercase" href="/login">J'ai déjà un compte</a>
    </div>
</form>
<?php require APPROOT . '/views/includes/footer.php'; ?>
