<?php
$id = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $table = $_GET['table'];
    if ($table === 'students') {
        $id = 'id_student = ' . $_GET['del_id'];
    } elseif ($table === 'teachers') {
        $id = 'id_teacher = ' . $_GET['del_id'];
    } elseif ($table === 'groups') {
        $id = 'id_group = ' . $_GET['del_id'];
    } elseif ($table === 'lessons') {
        $id = 'id_lesson = ' . $_GET['del_id'];
    }
    deleteRow($table, $id);
    header('location: ' . 'index.php');
}