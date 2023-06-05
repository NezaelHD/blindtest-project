<?php require APPROOT . '/views/includes/header.php'; ?>
<div class="hero">
    <div class="overlay">
        <div class="text">
            <h1><?= $data['title']; ?> Mets tes connaissances à l'épreuve avec notre expérience ultime de blind test
                !</h1>
            <p>Plonge-toi dans l'univers du son avec tes amis</p>
        </div>
        <a href="#anchor-blindtest">
            <button type="button" class="btn">Commencer à jouer</button>
        </a>
    </div>
</div>
<div id="anchor-blindtest"></div>
<div id="blindtest-cards">
    <h2>Nos blindtests</h2>
    <p>Commencez immédiatemment à jouer en choisissant un des blindtests disponibles !</p>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/80.jpg" alt="Années 80"></div>
                <div class="card-body">
                    <h5 class="card-title">Années 80 Pop</h5>
                    <p class="card-text">Créateur: John Doe</p>
                    <p class="card-description">Testez vos connaissances sur les succès pop des années 80 avec ce blindtest rempli de tubes incontournables de cette décennie haute en couleurs.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/cinema.jpg" alt="Image 2"></div>
                <div class="card-body">
                    <h5 class="card-title">Cinéma</h5>
                    <p class="card-text">Créateur: Jane Smith</p>
                    <p class="card-description">Mettez à l'épreuve votre culture cinématographique en devinant les bandes sonores emblématiques de films célèbres, des classiques du cinéma jusqu'aux blockbusters récents.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/tv.jpg" alt="Image 3"></div>
                <div class="card-body">
                    <h5 class="card-title">Génériques de séries TV</h5>
                    <p class="card-text">Créateur: Robert Johnson</p>
                    <p class="card-description">Êtes-vous un fan de séries télévisées ? Testez vos connaissances en identifiant les génériques de séries cultes, des classiques des années 80 jusqu'aux séries actuelles.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/2000.jpg" alt="Image 1"></div>
                <div class="card-body">
                    <h5 class="card-title">Hits des années 2000</h5>
                    <p class="card-text">Créateur: John Doe</p>
                    <p class="card-description">Revivez les succès musicaux des années 2000 en reconnaissant les tubes pop, rock et R&B qui ont dominé les ondes pendant cette décennie.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/Jay-Z.jpg" alt="Image 2"></div>
                <div class="card-body">
                    <h5 class="card-title">Hip-Hop et Rap</h5>
                    <p class="card-text">Créateur: Jane Smith</p>
                    <p class="card-description">Mettez à l'épreuve votre connaissance du hip-hop et du rap en identifiant les artistes, les paroles et les beats des morceaux les plus emblématiques du genre.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/kurt.jpg" alt="Image 3"></div>
                <div class="card-body">
                    <h5 class="card-title">Années 90 Grunge</h5>
                    <p class="card-text">Créateur: Robert Johnson</p>
                    <p class="card-description">Plongez dans l'univers grunge des années 90 en écoutant des morceaux emblématiques de groupes tels que Nirvana, Pearl Jam et Soundgarden.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/mickey.jpg" alt="Image 1"></div>
                <div class="card-body">
                    <h5 class="card-title">Disney</h5>
                    <p class="card-text">Créateur: John Doe</p>
                    <p class="card-description">Testez votre mémoire musicale en identifiant les chansons classiques des films Disney, des princesses aux films d'animation les plus récents.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/rock.jpg" alt="Image 2"></div>
                <div class="card-body">
                    <h5 class="card-title">Rock'n'Roll légendaire</h5>
                    <p class="card-text">Créateur: Jane Smith</p>
                    <p class="card-description">Reconnaissez les riffs de guitare emblématiques et les voix légendaires du rock'n'roll classique avec ce blindtest dédié aux pionniers du genre.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card custom-bg">
                <div class="rectangle-img d-flex align-items-center"><img class="card-img-top" src="../../public/assets/img/Beach.jpg" alt="Image 3"></div>
                <div class="card-body">
                    <h5 class="card-title">Hits de l'été</h5>
                    <p class="card-text">Créateur: Robert Johnson</p>
                    <p class="card-description">Rafraîchissez-vous en écoutant les tubes estivaux qui ont marqué les vacances d'été au fil des années, des chansons festives aux incontournables de la saison.</p>
                    <a href="#" class="btn btn-primary">Jouer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //= isset($_SESSION['logged_in']) === true ? "Bienvenue " . $_SESSION['user']['name'] : '' ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>
