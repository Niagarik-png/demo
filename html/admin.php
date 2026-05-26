<?php
require_once __DIR__ . '/app/load.php';

$msg = '';
$errors = [];

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    redirect('/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateStatus'])){
    $applicationId = $_POST['applicationId'];
    $newStatus = $_POST['newStatus'];
    $allowedStatuses = ['Новая', 'Банкет назначен', 'Банкет завершен'];

    if (in_array($newStatus, $allowedStatuses)) {
        if (Application::updateStatus($applicationId, $newStatus)) {
            $msg = 'Статус заявки' . $applicationId . 'изменен';
        } else {
            $errors[] = 'Недопустимый статус';
        }
    }
}

$applications = Application::getAllApps();

?>

<!DOCTYPE html>
<html lang="ru">
<?=template('head')?>
<body>
<?=template('header')?>

<div class="container-fluid mt-5 px-4">
    <h2>Панель администратора</h2>
    <?php if (!empty($msg)) :?>
        <div class="alert alert-success"><?= $msg?></div>
    <?php endif ; ?>
    <div class="card">
        <div class="card-body">
            <?php if (empty($applications)) :?>
                <div class="alert alert-info">У нас тут пусто (</div>
            <?php else:  ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Клиент</th>
                                <th scope="col">Контакты</th>
                                <th scope="col">Помещение</th>
                                <th scope="col">Дата банкета</th>
                                <th scope="col">Оплата</th>
                                <th scope="col">Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($applications as $application): ?>
                            <tr>
                                <td><?= $application['id'] ?></td>
                                <td><?= htmlspecialchars($application['full_name']) ?></td>
                                <td><?= htmlspecialchars($application['phone']) ?></td>
                                <td><?= htmlspecialchars($application['room_name']) ?></td>
                                <td><?= date('d.m.Y', strtotime($application['event_date'])) ?></td>
                                <td><?= htmlspecialchars($application['payment']) ?></td>
                                <td>
                                    <form action="admin.php" method="post" class='d-flex align-items-center me-2 gap-2'>
                                        <input type="hidden" name="applicationId" value="<?= $application['id']?>">
                                        <select name="newStatus" class="form-select form-select-sm">
                                            <option value="Новая" <?= $application['status'] === 'Новая'? 'selected' : '' ?>>Новая</option>
                                            <option value="Банкет назначен" <?= $application['status'] === 'Банкет назначен'? 'selected' : '' ?>>Банкет назначен</option>
                                            <option value="Банкет завершен" <?= $application['status'] === 'Банкет завершен'? 'selected' : '' ?>>Банкет завершен</option>
                                        </select>

                                        <button type="submit" name="updateStatus" class="btn btn-sm btn-primary">Сохранить</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ;?>
        </div>
    </div>
</div>
</body>
</html>