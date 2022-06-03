<?php
include '../path.php';
include SITE_ROOT  . '/app/include/redirectAdmin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
    <title>Главная</title>
</head>
<body>
<div class="wrapper">
    <?php include SITE_ROOT . '/app/include/header.php' ?>
    <main class="main">
        <div class="container">
            <div class="reports">
                <div class="title">Общая статистика</div>
                <div class="reports_body">
                    <a href="#" class="stat">1</a>
                    <a href="#" class="stat">2</a>
                    <a href="#" class="stat">3</a>
                    <a href="#" class="stat">4</a>
                    <a href="#" class="stat">5</a>
                    <a href="#" class="stat">6</a>
                </div>
            </div>
            <div class="reports">
                <div class="title">Отчёты</div>
                <div class="reports_body">
                    <a href="#" class="report">Отчёт</a>
                    <a href="#" class="report">Отчёт</a>
                    <a href="#" class="report">Отчёт</a>
                </div>
            </div>
            <div class="control_buttons">
                <a href="<?=BASE_URL?>logout.php">Выход</a>
            </div>
        </div>

    </main>
    <footer>

<div class="container"></div>
    <span>Create ya</span>
</footer>
    <script src="js/app.min.js?_v=20220408225305"></script>
</div>
</body>
</html>