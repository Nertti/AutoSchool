<?php include '../path.php';
include SITE_ROOT . '/app/include/redirectTeacher.php';
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
        <div class="container XXL">
            <div class="table_page">
                <div class="title">Расписание на следующую неделю</div>
                <div class="table">
                    <div class="head_table">
                        <span class="timetable_block">Группы\Дата</span>
                        <?php for ($i = 0; $i < 6; $i++): ?>

                            <span class="timetable_block"><?=$day_of_week[$i]?><br><?=$next_week[$i]?></span>
                        <?endfor;?>
                    </div>
                    <div class="body_table">
                        <?php foreach ($groups as $key => $group): ?>
                            <div class="row_table">
                                <span class="timetable_block">
                                    <?=$group['number']?>
                                </span>
                                <?php
                                $this_date = date('Y-m-d', strtotime('monday next week'));
                                ?>
                                <?php foreach (callProc('proc_lessons_on_teacher', $group['id_group'] . ', "' .
                                    date('Y-m-d', strtotime('monday next week')) . '","' .
                                    date('Y-m-d', strtotime('saturday next week')) . '", ' . $_SESSION['id_teacher']) as $key => $lesson): ?>
                                    <?php while ($lesson['date'] !== $this_date): ?>
                                        <span class="timetable_block"></span>
                                        <?php
                                        $this_date = date('Y-m-d', strtotime($this_date . '+ 1 day'));
                                        ?>
                                    <?php endwhile; ?>
                                    <span class="timetable_block"><?=$lesson['name']?> <span class="cabinet" title="Кабинет"><?=$lesson['number']?></span><br>
                                        <?=$lesson['surname']?>
                                        <?= ' ' . mb_substr($lesson['name_t'], 0, 1) . '.' ?>
                                        <?= mb_substr($lesson['last_name'], 0, 1) . '.' ?>
                                    </span>
                                    <?php
                                    $this_date = date('Y-m-d', strtotime($this_date . '+ 1 day'));
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="control_buttons">
                    <a href="teacher.php" class="create">Текущая неделя</a>
                </div>
            </div>

        </div>
    </main>

    <?php include SITE_ROOT . '/app/include/footer.php' ?>

</div>
</body>
</html>