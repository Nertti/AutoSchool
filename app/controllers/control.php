<?php
$error = '';
$name = '';
$surname = '';
$last_name = '';
$login = '';
$pass = '';
$passport = '';
$phone = '';
$number = '';
$date = '';
include SITE_ROOT . '/app/db/db.php';
include SITE_ROOT . '/app/controllers/select.php';
include SITE_ROOT . '/app/controllers/registry.php';
///////
include SITE_ROOT . '/app/controllers/sort_find.php';
///////
include SITE_ROOT . '/app/controllers/add_rows.php';
include SITE_ROOT . '/app/controllers/del.php';
include SITE_ROOT . '/app/controllers/edit.php';
include SITE_ROOT . '/app/controllers/timetable.php';
///////
include SITE_ROOT . '/app/PHPExcel/PHPExcel.php';
include SITE_ROOT . '/app/controllers/PHPExcel_control.php';
