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
        <div class="container">
            <div class="table_page">
                <div class="title">Учащиеся</div>
                <div class="search">
                    <label>
                        Поиск курсанта по фамилии:
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
                        <a class="group left-border" href="#">Группа</a>
                        <span class="phone">Телефон</span>
                        <span class="control">Управление</span>
                    </div>
                    <div class="body_table">
                        <div class="row_table">
                            <span class="number">1</span>
                            <span class="surname">Титова А.Д.</span>
                            <span class="group left-border">Т917</span>
                            <span class="phone">+375445753201</span>
                            <div class="control">
                                <a class="edit" href="#">Изменить</a>
                                <a class="delete" href="#">Удалить</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>