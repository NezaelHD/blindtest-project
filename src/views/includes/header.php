<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Are you blinded</title>
    <link rel="icon" type="image/png" href="../../../public/assets/img/fav.png">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
    $connectedUser = getConnectedUser();
?>
<header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand logo" href="/"><img src="../../public/assets/img/logo.png" alt="logo"></a>
        <p class="navbar-text">Are You Blinded?</p>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (!$connectedUser) : // Not connected ?>
                    <li class="nav-item">
                        <a class="nav-link btn" href="/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="/login">Login</a>
                    </li>
                <?php endif; ?>
                <?php if ($connectedUser) : // Connected but not admin ?>
                    <li class="nav-item">
                        <a class="nav-link btn" href="/profil">Mon Profil</a>
                    </li>
                <?php endif; ?>
                <?php  if ($connectedUser && $connectedUser['isAdmin']) : // Connected and admin ?>
                    <li class="nav-item">
                        <a class="nav-link btn" href="/admin">Admin</a>
                    </li>
                <?php endif; ?>
                <?php if ($connectedUser) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
