<?php include 'path.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Вход</title>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
</head>
<body>
<div class="wrapper">
    
    <main class="main">
        <div class="login_wrap">
            <form action="" class="login">
                <div class="title">Войти в приложение</div>
                <div class="error_msg"></div>
                <div class="wrap_input">
                    <label>
                        Логин:
                        <input type="text">
                    </label>
                    <label>
                        Пароль:
                        <input type="password">
                    </label>
                    <button class="login-btn">Войти</button>
                </div>
            </form>
        </div>
    </main>
    <footer>

<div class="container"></div>
    <span>Create ya</span>
</footer>
    <script src="js/app.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/JQuery.js"></script>
</div>
</body>
</html>