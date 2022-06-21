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
                <div class="title">Изменение/Просмотр информации преподавателя</div>
                <div class="error_msg"><?= $error ?></div>
                <form action="" class="form" method="post">
                    <label>
                        Фамилия:
                        <input type="text" name="surname" value="<?= $teacher['surname'] ?>" required>
                    </label>
                    <label>
                        Имя:
                        <input type="text" name="name" value="<?= $teacher['name'] ?>" required>
                    </label>
                    <label>
                        Отчество:
                        <input type="text" name="last_name" value="<?= $teacher['last_name'] ?>" required>
                    </label>
                    <label>
                        Телефон:
                        <input type="text" name="phone" value="<?= $teacher['phone'] ?>" required>
                    </label>
                    <label>
                        Паспорт:
                        <input type="text" name="passport" value="<?= $teacher['passport'] ?>" required>
                    </label>
                    <label>
                        Логин:
                        <input type="text" name="login" value="<?= $teacher['login'] ?>" required>
                    </label>
                    <label>
                        <span class="required">Ставка в неделю:</span>
                        <select name="id_time_work" required>
                            <?php foreach ($time_work as $key => $time): ?>
                                <option <?php if($time['id_time_work'] == $teacher['id_time_work']) {echo 'selected';}  ?> value="<?= $time['id_time_work']; ?>"><?= $time['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <div class="control_buttons">
                        <button class="btn" name="btn-update" type="submit" value="teachers">Изменить</button>
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