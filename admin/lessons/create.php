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
                <div class="title">Создание урока</div>
                <div class="error_msg"><?= $error ?></div>
                <form action="" class="form" method="post">
                    <label>
                        <span class="required">Тема занятия:</span>
                        <input type="text" name="name" value="<?= $name ?>" required>
                    </label>
                    <label>
                        <span class="required">Дата проведения:</span>
                        <input type="date" name="date" value="" required>
                    </label>
                    <label>
                        <span class="required">Кабинет:</span>
                        <select name="id_cabinet" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($cabinets as $key => $cabinet): ?>
                                <option value="<?= $cabinet['id_cabinet']; ?>"><?= $cabinet['number']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        <span class="required">Группа:</span>
                        <select name="id_group" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($groups as $key => $group): ?>
                                <option value="<?= $group['id_group']; ?>"><?= $group['number']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        <span class="required">Преподаватель:</span>
                        <select name="id_teacher" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($teachers as $key => $teacher): ?>
                                <option value="<?= $teacher['id_teacher']; ?>"><?= $teacher['surname']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <div class="control_buttons">
                        <button class="btn" name="btn-add" type="submit" value="lessons">Создать занятие</button>
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