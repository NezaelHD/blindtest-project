<?php  require APPROOT . '/views/includes/header.php'; ?>
<h1>Blindtest <?= $data['blindtest']->getName(); ?></h1>
<div id="userListContainer">
    <h3>Listes des utilisateurs connectés</h3>
    <ul id="playerList"></ul>
</div>
<div id="game-instance" class="container" data-room_id="<?= $data['room_id'] ?>" data-blindtest_id="<?= $data['blindtest']->getId(); ?>" data-user_id="<?= getConnectedUser()['id']?>">
</div>
<?php  require APPROOT . '/views/includes/footer.php'; ?>
