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
                <div class="title">Преподаватели</div>
                <div class="search">
                    <label>
                        Поиск преподавателя по фамилии:
                        <input type="text" name="search">
                    </label>
                    <div class="control">
                        <button>Найти</button>
                        <button>Сбросить</button>
                    </div>
                </div>
                <div class="table">
                    <div class="head_table">
                        <a class="number" href="#">№</a>
                        <a class="surname" href="#">Фамилия И.О.</a>
                        <span class="phone">Телефон</span>
                        <span class="control">Управление</span>
                    </div>
                    <div class="body_table">
                        <?php foreach ($teachers as $key => $teacher): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $teacher['surname'] . ' ';
                                    echo mb_substr($teacher['name'], 0, 1) . '.';
                                    echo mb_substr($teacher['last_name'], 0, 1) . '.'; ?></span>
                                <span class="phone"><?=$teacher['phone']?></span>
                                <span class="control">
                                <a class="edit" href="edit.php?table=teachers&id_edit=<?= $teacher['id_teacher']; ?>">Информация</a>
                                <a class="delete" onClick="return window.confirm('Удалить преподавателя из базы?');" href="?table=teachers&del_id=<?= $teacher['id_teacher']; ?>">Удалить</a>
                            </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="control_buttons">
                    <a href="create.php" class="create">Создать</a>
                    <a href="index.php" class="create">Назад</a>
                </div>
            </div>

        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>