<?php require APPROOT . '/views/includes/header.php';

use App\Repository\UserRepository;
?>
<div class="hero">
    <div class="overlay">
        <div class="text">
            <h1><?= $data['title']; ?> Mets tes connaissances à l'épreuve avec notre expérience ultime de blind test !</h1>
            <p>Plonge-toi dans l'univers du son avec tes amis</p>
        </div>
        <a href="#anchor-blindtest" class="btn">Découvrir les blindtests</a>
        <a class="btn roombtn" href="#anchor-room">Rejoindre une room</a>
    </div>
</div>
<div id="anchor-room"></div>
<div class="room">
    <h2>Rejoindre une room de blindtest</h2>
    <div class="centered-input">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <input type="text" class="form-control inline-form input-lg" id="roomCode" placeholder="Entrez le code">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <button type="button" id="btn-join" class="btn btn-lg btn-block">Rejoindre</button>
            </div>
        </div>
    </div>
</div>
<div id="anchor-blindtest"></div>
<div id="blindtest-cards">
    <h2>Nos blindtests</h2>
    <p>Commencez immédiatemment à jouer en choisissant un des blindtests disponibles !</p>
    <div class="row">
        <?php foreach ($data['tableUserBlindtest'] as $blindtestuser) : ?>
        <!--instancier user et recuperer auteur-->
<!--        --><?php //$userRepo = new UserRepository();
//            $user= $userRepo->find($blindtest->getAuthor()); ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/concert.jpg" alt="Années 80"></div>
                <div class="card-body">
                    <h5 class="card-title"><?= $blindtestuser['blindtest']->getName(); ?></h5>
                    <p class="card-text">Créateur: <?= $blindtestuser['author']->getName(); ?></p>
                    <p class="card-description"><?= $blindtestuser['blindtest']->getDescription(); ?></p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php //= isset($_SESSION['logged_in']) === true ? "Bienvenue " . $_SESSION['user']['name'] : '' ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>

