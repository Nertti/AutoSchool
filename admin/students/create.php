<?php include '../../path.php' ?>
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
                <div class="error_msg"></div>
                <form action="" class="form">
                    <label>
                        Фамилия:
                        <input type="text" name="surname">
                    </label>
                    <label>
                        Имя:
                        <input type="text" name="surname">
                    </label>
                    <label>
                        Отчество:
                        <input type="text" name="surname">
                    </label>
                    <label>
                        Телефон:
                        <input type="text" name="surname">
                    </label>
                    <label>
                        Паспорт:
                        <input type="text" name="surname">
                    </label>
                    <div class="control_buttons">
                        <button>Создать</button>
                        <button>Назад</button>
                    </div>
                </form>
            </div>

        </div>    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>