<?php
$id = '';
if (isset($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $table = $_GET['table'];
    if ($table === 'students') {
        $student = selectOne($table, ['id_student' => $id]);
    } elseif ($table === 'teachers') {
        $teacher = selectOne($table, ['id_teacher' => $id]);
    } elseif ($table === 'groups') {
        $group = selectOne($table, ['id_group' => $id]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-update'])) {
    $table = trim($_POST['btn-update']);
    if ($table === 'students') {
        $id = 'id_student = ' . $_GET['id_edit'];
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $passport = trim($_POST['passport']);
        $phone = str_replace([' ', '(', ')', '-',], '', trim($_POST['phone']));
        if ($name === '' || $surname === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($surname) > 50) {
            $error = 'Слишком длинная фамилия!';
        } elseif (iconv_strlen($last_name) > 50) {
            $error = 'Слишком длинное отчество!';
        } elseif (!preg_match($preg_phone, $phone)) {
            $error = 'Введите верный телефон';
        } elseif (!preg_match($preg_passport, $passport) && $passport != '') {
            $error = 'Введите верный паспорт';
        } else {
            $post = [
                'name' => $name,
                'surname' => $surname,
                'last_name' => $last_name,
                'phone' => $phone,
                'passport' => $passport,
            ];
            updateRow('students', $id, $post);
            header('location: ' . 'index.php');
        }

    }
    //ok
    if ($table === 'teachers') {
        $id = 'id_teacher = ' . $_GET['id_edit'];
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $passport = trim($_POST['passport']);
        $id_time_work = trim($_POST['id_time_work']);
        $phone = str_replace([' ', '(', ')', '-',], '', trim($_POST['phone']));
        if ($name === '' || $surname === '' || $login === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($surname) > 50) {
            $error = 'Слишком длинная фамилия!';
        } elseif (iconv_strlen($last_name) > 50) {
            $error = 'Слишком длинное отчество!';
        } elseif (iconv_strlen($login) < 3 || iconv_strlen($login) > 15) {
            $error = 'Длина логина может быть от 3 до 15 символов!';
        } elseif (!preg_match($preg_phone, $phone) && !$phone == '') {
            $error = 'Введите верный телефон';
        } elseif (!preg_match($preg_passport, $passport) && $passport != '') {
            $error = 'Введите верный паспорт';
        } else {
            $post = [
                'name' => $name,
                'surname' => $surname,
                'last_name' => $last_name,
                'login' => $login,
                'phone' => $phone,
                'passport' => $passport,
                'id_time_work' => $id_time_work,
            ];
            updateRow('teachers', $id, $post);
            header('location: ' . 'index.php');
        }

    }
    //ok
    if ($table === 'groups') {
        $id = 'id_group = ' . $_GET['id_edit'];
        $number = trim($_POST['number']);
        $category = trim($_POST['id_category']);
        $time = trim($_POST['id_time_group']);
        $count = trim($_POST['count']);
        if ($number === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (iconv_strlen($number) > 5) {
            $error = 'Слишком длинный номер группы!';
        } else {
            $post = [
                'number' => $number,
                'id_category' => $category,
                'id_time' => $time,
                'count_students' => $count,
            ];
            updateRow('groups', $id, $post);
            header('location: ' . 'index.php');
        }
    }
    //ok
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['add_student_id'])) {
    $id = 'id_student = ' . $_GET['add_student_id'];
    $id_group = $_GET['id_group'];
    $group = selectOne('groups', ['id_group' => $id_group]);
//    $students_count = callProc('proc_student', $_GET['id_group']);
    if(count($students_in_group) >= $group['count_students']){
        $error = 'Лимит учащихся ' . $group['count_students'];
    }else{
        $post = [
            'id_group' => $_GET['id_group'],
        ];
        updateRow('students', $id, $post);
        header('location: ' . 'edit_stud_in_group.php?id_group=' . $_GET['id_group'] . '&number=' . $group['number']);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_student_id'])) {
    $id =  'id_student = ' . $_GET['del_student_id'];
    $post = [
        'id_group' => 'NULL',
    ];
    $id_group = $_GET['id_group'];
    $group = selectOne('groups', ['id_group' => $id_group]);
    updateRow('students', $id, $post);
    header('location: ' . 'edit_stud_in_group.php?id_group=' . $_GET['id_group'] . '&number=' . $group['number']);
}