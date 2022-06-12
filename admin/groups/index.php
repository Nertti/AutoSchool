<?php include '../../path.php';
include SITE_ROOT . '/app/include/redirectAdmin.php';
?><!DOCTYPE html>
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
            <div class="table_page">
                <div class="title">Группы</div>
                <form method="post" class="search">
                    <label>
                        Поиск группы по номеру:
                        <input type="text" value="<?= $find_sql ?>" name="search">
                    </label>
                    <div class="control">
                        <button type="submit" value="select_groups" name="find">Найти</button>
                        <button type="submit" value="select_groups" name="reset">Сбросить</button>
                    </div>
                </form>
                <div class="table">
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="group left-border<?php echo sort_link_bar('Номер', 'number_asc', 'number_desc', 'groups'); ?></a>
                        <a class="phone<?php echo sort_link_bar('Категория', 'category_asc', 'category_desc', 'groups'); ?></a>
                        <span class="control">Управление</span>
                    </div>
                    <div class="body_table">
                        <?php foreach ($groupsVIEW as $key => $group): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="group left-border"><?=$group['number']?></span>
                                <span class="phone"><?=$group['name']?></span>
                                <span class="control">
                                <a class="edit" href="group_info.php?table=groups&id_group=<?= $group['id_group']; ?>&number=<?= $group['number']; ?>">Информация</a>
                                <a class="delete" onClick="return window.confirm('Удалить группу?');" href="?table=groups&del_id=<?= $group['id_group']; ?>">Удалить</a>
                            </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="control_buttons">
                    <a href="create.php" class="create">Создать</a>
                    <a href="javascript:history.go(-1)" class="create">Назад</a>
                </div>
            </div>

        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>