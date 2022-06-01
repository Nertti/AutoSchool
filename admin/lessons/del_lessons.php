<?php include '../../path.php';
include SITE_ROOT . '/app/include/redirectAdmin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Вход</title>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
</head>
<body>
<div class="wrapper">
    <?php include SITE_ROOT . '/app/include/header.php' ?>
    <main class="main">
        <div class="container L">
            <div class="table_page">
                <div class="title">Занятия</div>
                <div class="table">
                    <div class="head_table">
                        <span class="number">№</span>
                        <span class="phone">Тема</span>
                        <span class="group">Кабинет</span>
                        <span class="group">Группа</span>
                        <span class="phone">ФИО учителя</span>
                        <span class="control">Управление</span>
                    </div>
                    <div class="body_table">
                        <?php foreach ($lessonsVIEW_order as $key => $lesson): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="phone"><?= $lesson['theme'] ?></span>
                                <span class="group"><?= $lesson['number'] ?></span>
                                <span class="group"><?= $lesson['group'] ?></span>
                                <span class="phone"><?php echo $lesson['surname'] . ' ';
                                    echo mb_substr($lesson['name'], 0, 1) . '.';
                                    echo mb_substr($lesson['last_name'], 0, 1) . '.'; ?></span>
                                <span class="control">
                                   <a class="delete" onClick="return window.confirm('Удалить занятие из расписания?');" href="?table=lessons&del_id=<?= $lesson['id_lesson']; ?>">Удалить</a>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="control_buttons">
<!--                    <a href="create.php" class="create">Создать</a>-->
                    <a href="index.php" class="create">Назад</a>
                </div>
            </div>

        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>