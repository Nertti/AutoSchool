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
                        <span class="required">Номер:</span>
                        <input type="text" name="number" value="<?= $number ?>" required>
                    </label>
                    <label>
                        <span class="required">Количество участников:</span>
                        <input type="number" min="0" max="30" name="count" value="<?= $count ?>" required>
                    </label>
                    <label>
                        <span class="required">Категория:</span>
                        <select name="id_category" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($categories as $key => $category): ?>
                                <option value="<?= $category['id_category']; ?>"><?= $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        <span class="required">Тип группы:</span>
                        <select name="id_time_group" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($time_group as $key => $time): ?>
                                <option value="<?= $time['id_time_group']; ?>"><?= $time['name']; ?></option>
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