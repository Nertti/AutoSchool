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
        <div class="table_page">

            <div class="title">Изменение состава группы</div>
            <div class="error_msg"><?= $error ?></div>

            <div class="container L two-tables">
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
                                <span class="control">
                                <a class="delete" onClick="return window.confirm('Удалить учащегося из группы?');"
                                   href="?del_student_id=<?= $student['id_student']; ?>&id_group=<?= $_GET['id_group']; ?>">Удалить</a>
                            </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="table">
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname" href="#">Фамилия И.О.</a>
                    </div>
                    <div class="body_table">
                        <?php foreach ($students_in_not_group as $key => $student): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $student['surname'] . ' ';
                                    echo mb_substr($student['name'], 0, 1) . '.';
                                    echo mb_substr($student['last_name'], 0, 1) . '.'; ?></span>
                                <span class="control">
                                <a class="add"
                                   href="?add_student_id=<?= $student['id_student']; ?>&id_group=<?= $_GET['id_group']; ?>&number=<?=$_GET['number']?>">Добавить</a>
                            </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="control_buttons">
                    <a href="group_info.php?id_group=<?=$_GET['id_group']?>&number=<?=$_GET['number']?>">Назад</a>
                </div>
            </div>
        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>