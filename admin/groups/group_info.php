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
        <div class="container S">
            <div class="table_page">
                <div class="title">Группа <?=$_GET['number']?></div>
                <div class="table">
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname" href="#">Фамилия И.О.</a>
                    </div>
                    <div class="body_table">
                        <?php foreach ($students_in_group as $key => $student): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $student['surname'] . ' ';
                                    echo mb_substr($student['name'], 0, 1) . '.';
                                    echo mb_substr($student['last_name'], 0, 1) . '.'; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="control_buttons">
                    <a href="edit_stud_in_group.php?id_group=<?=$_GET['id_group']?>&number=<?=$_GET['number']?>">Изменить состав</a>
                    <a href="edit.php?id_edit=<?=$_GET['id_group']?>&table=groups">Редактировать</a>
                    <a href="index.php">Назад</a>
                </div>

            </div>

        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>