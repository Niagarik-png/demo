<?php
require_once __DIR__ . '/app/load.php';

if (!isset($_SESSION['login'])) {
    redirect('/login.php');
}

$userId = $_SESSION['id'];
$msg = '';

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
            <th scope="col">Дата</th>
            <th scope="col">Способ оплаты</th>
            <th scope="col">Помещение</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $booking['id'] ?></td>
                <td><?= htmlspecialchars($booking['room_id']) ?></td>
                <td><?= date('d.m.Y H:i', strtotime($booking['event_date'])) ?></td>
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
</div>
</body>
</html>
