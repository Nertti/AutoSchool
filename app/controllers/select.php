<?php
$teachers = selectALL('teachers');
$admins = selectALL('admins');
$students = selectALL('students');
$studentsVIEW = selectALL('select_students');//view
$groups = selectALL('groups');
$groupsVIEW = selectALL('select_groups');//view
$lessons = selectALL('lessons');
$cabinets = selectALL('cabinets');
$categories = selectALL('categories');
$time_work = selectALL('time_work');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_group'])) {

    $students_in_group = callProc('proc_students', $_GET['id_group']);
    $students_in_not_group = selectALL('select_students_NULL');
}
