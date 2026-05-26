<header class="bg-body-tertiary">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Банкетам.Нет</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Главная</a>
                    </li>
                    <?php if (isset($_SESSION["full_name"], $_SESSION['role'])):?>
                    <li class="nav-item">
                        <a class="nav-link" href="application.php">Оставить заявку</a>
                    </li>
                        <?php if ($_SESSION["role"] === "admin"): ?>
                    <li class="nav-item">
                        <a href="/admin.php" class="nav-link">Паель-администратора</a>
                    </li>
                        <?php endif; ?>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION["full_name"];?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start">
                        <li><a class="dropdown-item" href="/profile.php">Личный кабинет</a></li>
                        <li><a class="dropdown-item" href="/logout.php">Выйти</a></li>
                    </ul>
                </div>
                <?php else:?>
                <div class="d-flex gap-2">
                    <a class="btn btn-primary" href="/login.php">Войти</a>
                    <a class="btn btn-outline-primary" href="/register.php">Регистрация</a>
                </div>
                <?php endif;?>
            </div>
        </div>
    </nav>
</header>