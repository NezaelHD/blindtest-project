<?php require APPROOT . '/views/includes/header.php'; ?>
    <div class="header_offset"></div>
    <h1 class="scoreboard-title">Page des scores</h1>
    <div class="container">
        <table class="table table-dark table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Blindtest ID</th>
                <th>User ID</th>
                <th>Score</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['scoreboard_datas'] as $score) : ?>
                <tr>
                    <td><?= $score->getId(); ?></td>
                    <td><?= $score->getBlindtestId(); ?></td>
                    <td><?= $score->getUserId(); ?></td>
                    <td><?= $score->getScore(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>