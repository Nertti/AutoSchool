<?php include '../../path.php';
include SITE_ROOT . '/app/include/redirectAdmin.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Вход</title>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
</head>
<body>
<div class="wrapper">
    <?php include SITE_ROOT . '/app/include/header.php' ?>
    <main class="main">
        <div class="container">
            <div class="table_page">
                <div class="title">Уроки</div>
<!--                <div class="search">-->
<!--                    <label>-->
<!--                        Поиск курсанта по фамилии:-->
<!--                        <input type="text" name="search">-->
<!--                    </label>-->
<!--                    <div class="control">-->
<!--                        <button>Найти</button>-->
<!--                        <button>Сбросить</button>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="table">
                    <div class="head_table">
                        <a class="number" href="#">№</a>
                        <a class="surname" href="#">Фамилия И.О.</a>
                        <a class="group left-border" href="#">Группа</a>
                        <span class="phone">Телефон</span>
                        <span class="control">Управление</span>
                    </div>
                    <div class="body_table">
                        <?php foreach ($students as $key => $student): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $student['surname'] . ' ';
                                    echo mb_substr($student['name'], 0, 1) . '.';
                                    echo mb_substr($student['last_name'], 0, 1) . '.'; ?></span>
                                <span class="group left-border">Т917</span>
                                <span class="phone"><?=$student['phone']?></span>
                                <span class="control">
                                <a class="edit" href="edit.php?table=students&id_edit=<?= $student['id_student']; ?>">Информация</a>
                                <a class="delete" onClick="return window.confirm('Удалить учащегося?');" href="?table=students&del_id=<?= $student['id_student']; ?>">Удалить</a>
                            </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>