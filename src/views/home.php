<?php  require APPROOT . '/views/includes/header.php'; ?>
<h1><?= $data['title']; ?></h1>
<?= isset($_SESSION['logged_in']) === true ? "Bienvenue " . $_SESSION['user']['name'] : '' ?>
<?php  require APPROOT . '/views/includes/footer.php'; ?>
