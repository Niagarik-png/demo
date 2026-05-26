<?php
require_once __DIR__ . '/app/load.php';

if (!isset($_SESSION['login'])) {
    redirect('/login.php');
}

$userId = $_SESSION['id'];
$errors = [];
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_review'])) {
    $reviewText = trim($_POST['reviewText']);

    if (empty($reviewText)) {
        $errors[] = 'Пожалуйста, напишите отзыв )';
    } else {
        if (Review::create($userId, $reviewText)) {
            $msg = 'Спасибо за ваш отзыв!';
        } else {
            $errors[] = 'Не удалось отправить отзыв';
        }
    }
}
$bookings = Application::getUserApps($userId);


?>

<!doctype html>
<html lang="ru">
<?=template('head');?>
<body>
<?=template('header');?>

<div class="container">
    <h1 class="mt-3">Ваши бронирования</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Помещение</th>
            <th scope="col">Дата</th>
            <th scope="col">Способ оплаты</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $booking['id'] ?></td>
                <td><?= htmlspecialchars($booking['room_name']) ?></td>
                <td><?= date('d.m.Y', strtotime($booking['event_date'])) ?></td>
                <td><?= htmlspecialchars($booking['payment']) ?></td>
                <td>
                    <?php
                    $badgeColor = 'bg-secondary'; // Новая
                    if ($booking['status'] === 'Банкет назначен') $badgeColor = 'bg-warning text-dark';
                    if ($booking['status'] === 'Банкет завершен') $badgeColor = 'bg-success';
                    ?>
                    <span class="badge <?= $badgeColor ?> fs-6">
                                            <?= htmlspecialchars($booking['status']) ?>
                                        </span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($booking['status'] === 'Банкет завершен'): ?>
        <div class="card mt-5 shadow-sm mb-5">
            <div class="card-body">
                <h4 class='card-title'>Оставить отзыв</h4>
                <?php if (!empty($msg)) :?>
                    <div class="alert alert-success"><?= $msg ?></div>
                <?php endif; ?>
                <form action="profile.php" method="post">
                    <div class="mb-3">
                        <textarea name="reviewText" class="form-control mb-3" rows="3" placeholder="Ваш отзыв" required></textarea>
                        <button type="submit" name="send_review" class="btn btn-primary">Отправить отзыв</button>    
                    </div>
                </form>  
            </div>
          
        </div>
    <?php endif; ?>

</div>
</body>
</html>
