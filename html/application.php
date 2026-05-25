<?php
require_once __DIR__ . '/app/load.php';

if (!isset($_SESSION['login'])) {
    redirect('/login.php');
}

$errors = [];

$rooms = Application::getRooms();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomId = $_POST['room_id'];
    $eventDate = $_POST['eventDate'];
    $payment = $_POST['payment'];

    if (empty($roomId) || empty($eventDate) || empty($payment)) {
        $errors[] = 'Enter all fields';
    }
    if (empty($errors)) {
        $userId = $_SESSION['id'];

        if (Application::create($userId, $roomId, $eventDate, $payment)) {
            redirect('/profile.php');
        } else {
            $errors[] = 'Something went wrong';
        }
    }
}

?>

<!doctype html>
<html lang="ru">
<?=template('head')?>
<body>
<?=template('header')?>

<div class="container">
    <h1 class="mt-3">Забронировать зал</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="application.php" method="post">
        <div class="form-group mb-3">
            <label>Помещение</label>
            <select name="room_id" class="form-select" required>
                <option value="">Выберите из списка</option>
                <?php foreach ($rooms as $room): ?>
                    <option value="<?= $room['id'] ?>"><?= htmlspecialchars($room['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Дата начала</label>
            <input type="date" class="form-control" name="eventDate">
        </div>
        <div class="form-group mb-3">
            <label>Способ оплаты</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" value="Наличные" id="pay1" checked>
                <label class="form-check-label" for="pay1">Наличные</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" value="Банковская карта" id="pay2">
                <label class="form-check-label" for="pay2">Банковская карта</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Забронировать</button>
    </form>
</div>
</body>
</html>