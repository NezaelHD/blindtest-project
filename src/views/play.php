<?php require APPROOT . '/views/includes/header.php'; ?>
<div class="room-container flex">
    <div class="flex-content">
        <h1 class="room-title">Blindtest <?= $data['blindtest']->getName(); ?></h1>
        <div id="game-instance" class="container" data-room_id="<?= $data['room_id'] ?>"
             data-blindtest_id="<?= $data['blindtest']->getId(); ?>" data-user_id="<?= getConnectedUser()['id'] ?>">
        </div>
    </div>
</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>
