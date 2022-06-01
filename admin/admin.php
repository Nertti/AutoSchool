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
            <div class="error_msg" style="text-align: right"><a href="<?=BASE_URL?>logout.php">Выход</a></div>

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