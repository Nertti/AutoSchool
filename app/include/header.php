<header>
    <div class="nav lock-padding">
        <div class="container">
            <div class="nav__head">
                <div class="logo">
                    <div class="nav__logo">
                        <span class="redLogo">Профи</span>Авто
                    </div>
                </div>
                <div class="nav__burger">
                    <span></span>
                </div>
                <div class="nav__menu" style="justify-content: end">
                    <?php if (isset($_SESSION['id_admin'])): ?>
                        <ul class="nav__list">
                            <li><a href="<?php echo BASE_URL ?>admin/students/index.php">Учащиеся</a></li>
                            <li><a href="<?php echo BASE_URL ?>admin/teachers/index.php">Преподаватели</a></li>
                            <li><a href="<?php echo BASE_URL ?>admin/groups/index.php">Группы</a></li>
                            <li><a href="<?php echo BASE_URL ?>admin/lessons/index.php">Расписание</a></li>
                            <li><a href="<?php echo BASE_URL ?>admin/admin.php">Администратор</a></li>
                        </ul>
                    <?php elseif (isset($_SESSION['id_teacher'])): ?>
                        <a><?=$_SESSION['surname']?></a>
                        <a href="<?= BASE_URL ?>logout.php">Выход</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
