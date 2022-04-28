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
            <div class="create_page">
                <div class="title">Добавление нового курсанта</div>
                <div class="error_msg"><?= $error ?></div>
                <form action="" class="form" method="post">
                    <label>
                        Фамилия:
                        <input type="text" name="surname" value="<?= $surname ?>" required>
                    </label>
                    <label>
                        Имя:
                        <input type="text" name="name" value="<?= $name ?>" required>
                    </label>
                    <label>
                        Отчество:
                        <input type="text" name="last_name" value="<?= $last_name ?>" required>
                    </label>
                    <label>
                        Телефон:
                        <input type="text" name="phone" value="<?= $phone ?>" required>
                    </label>
                    <label>
                        Паспорт:
                        <input type="text" name="passport" value="<?= $passport ?>">
                    </label>
                    <div class="control_buttons">
                        <button name="btn-add" type="submit" value="students">Создать</button>
                        <a href="index.php">Назад</a>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>