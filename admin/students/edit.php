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
                <div class="title">Изменение/просмотр информации</div>
                <div class="error_msg"><?= $error ?></div>
                <form action="" class="form" method="post">
                    <label>
                        Фамилия:
                        <input type="text" name="surname" value="<?= $student['surname'] ?>" required>
                    </label>
                    <label>
                        Имя:
                        <input type="text" name="name" value="<?= $student['name'] ?>" required>
                    </label>
                    <label>
                        Отчество:
                        <input type="text" name="last_name" value="<?= $student['last_name'] ?>" required>
                    </label>
                    <label>
                        Телефон:
                        <input type="text" name="phone" value="<?= $student['phone'] ?>" required>
                    </label>
                    <label>
                        Паспорт:
                        <input type="text" name="passport" value="<?= $student['passport'] ?>">
                    </label>
                    <div class="control_buttons">
                        <button class="btn" name="btn-update" type="submit" value="students">Изменить</button>
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