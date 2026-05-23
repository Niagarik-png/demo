<?php
require_once __DIR__ . '/app/load.php';

?>

<!doctype html>
<html lang="ru">
<?=template('head')?>
<body>
<?=template('header')?>

<div class="container">
    <h1 class="mt-3">Забронировать зал</h1>
    <form action="application.php" method="post">
        <div class="form-group mb-3">
            <label>Помещение</label>
            <select class="form-select">
                <option>Зал</option>
                <option>Ресторан</option>
                <option>Летняя веранда</option>
                <option>Закрытая веранда</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Дата начала</label>
            <input type="date" class="form-control" name="date">
        </div>
        <div class="form-group mb-3">
            <label>Способ оплаты</label>
            <select class="form-select">
                <option>Наличные</option>
                <option>Картой</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Забронировать</button>
    </form>
</div>
</body>
</html>