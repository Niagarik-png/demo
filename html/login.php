<?php
require_once __DIR__ . '/app/load.php';

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'login' => trim($_POST['login']),
        'password' => $_POST['password']
    ];

    if(empty($data['login']) || empty($data['password'])){
        $errors[] = 'Заполните все поля!';
    }

    if (empty($errors)) {
        try {
            $user = User::login($data);

            $_SESSION['login'] = $user->login;
            $_SESSION['full_name'] = $user->full_name;
            $_SESSION['role'] = $user->role;
            $_SESSION['id'] = $user->id;

            if ($_SESSION['role'] == 'admin') {
                redirect('/admin.php');
            } else {
                redirect('/index.php');
            }
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html lang="ru">
<?=template('head');?>
<body>
<?=template('header');?>

<div class="container">
    <h1 class="mt-3">Вход</h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div class="form-group mb-3">
            <label>Логин</label>
            <input type="text" name="login" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Вход</button>
        <p>Еще нет аккаунта? <a href="/register.php">Регистрация</a></p>
    </form>
</div>
</body>
</html>
