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
                <div class="reports_stat">
                    <?php
                    $student_report = report('students');
                    $teachers_report = report('teachers');
                    $groups_report = report('groups');
                    ?>
                    <div class="stat_info"><span>Количество учащихся в автошколе:</span> <span class="stat"><?= $student_report['count']?></span></div>
                    <div class="stat_info"><span>Количество преподавателей в автошколе:</span> <span class="stat"><?= $teachers_report['count']?></span></div>
                    <div class="stat_info"><span>Количество групп в автошколе:</span> <span class="stat"><?= $groups_report['count']?></span></div>
                </div>
            </div>
            <div class="reports">
                <div class="title">Отчёты</div>
                <div class="reports_body">
                    <a href="?report_1" class="report">Занятость перподавателей</a>
                    <a href="?report_2" class="report">Занятия у групп</a>
                    <a href="?report_3" class="report">Учащиеся</a>
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