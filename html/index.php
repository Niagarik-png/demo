<?php
require_once __DIR__ . "/app/load.php";
?>

<!doctype html>
<html lang="ru">
<?= template('head')?>
<body>
    <?= template('header')?>
    <div class="container">
        <h1>Добро пожаловать на Банкетам.Нет</h1>
        <p>Здесь должен быть текст</p>
        <h2>Наши залы</h2>
        <div id="carousel" class="carousel slide mt-3" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/1.jpeg" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="./images/2.jpg" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="./images/3.jpg" class="d-block w-100" alt="Slide 3">
                </div>
                <div class="carousel-item">
                    <img src="./images/4.jpg" class="d-block w-100" alt="Slide 4">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
