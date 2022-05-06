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
                <div class="title">Создание группы</div>
                <div class="error_msg"><?= $error ?></div>
                <form action="" class="form" method="post">
                    <label>
                        Номер:
                        <input type="text" name="number" value="<?= $number ?>" required>
                    </label>
                    <label>
                        Преподаватель:
                        <select name="id_teacher" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($teachers as $key => $teacher): ?>
                                <option value="<?= $teacher['id_teacher']; ?>"><?= $teacher['surname']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        Категория:
                        <select name="id_category" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($categories as $key => $category): ?>
                                <option value="<?= $category['id_category']; ?>"><?= $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <div class="control_buttons">
                        <button class="btn" name="btn-add" type="submit" value="groups">Создать</button>
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