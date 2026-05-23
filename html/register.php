<?php
require_once __DIR__ . '/app/load.php';

$errors = [];

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {

    $data = [
            'login' => trim($_POST['login']),
        'full_name' => trim($_POST['full_name']),
        'email' => trim($_POST['email']),
        'phone'=> trim($_POST['phone']),
        'password' => $_POST['password']
    ];

    if (empty($data['full_name']) || empty($data['login']) || empty($data['email']) || empty($data['phone'])) {
        $errors[] = 'Поля обязательны для заполнения';
    }
    if (!preg_match('/^[A-Za-z0-9]{6,}$/', $data['login'])) {
        $errors[] = 'Логин 6 символов, латиница';
    }
    if (mb_strlen($data['password']) < 8) {
        $errors[] = 'Длина пароля 8 символов';
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] ='Некорректный Email';
    }
    if(empty($errors)) {
        try {
            User::register($data);
            redirect('/index.php');
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
}

?>


<!doctype html>
<html lang="ru">
<?= template('head') ?>
<body>
<?= template('header') ?>
<div class="container">
    <h1 class="mt-3">Регистрация</h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" class="form-horizontal">
        <div class="form-group mb-3">
            <label>ФИО</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Логин</label>
            <input type="text" name="login" class="form-control" required pattern="[A-Za-z0-9]{6,}" title="Латиница и цифры, длина 6 символов">
        </div>
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Телефон</label>
            <input type="tel" name="phone" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" minlength="8" required>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Регистрация</button>
        <p>Уже есть аккаунт? <a href="/login.php">Войти</a></p>
    </form>
</div>
</body>
</html>