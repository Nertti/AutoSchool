<?php
$id = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_edit'])) {
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
            ];
            updateRow('teachers', $id, $post);
            header('location: ' . 'index.php');
        }

    }
    //ok
    if ($table === 'groups') {
        $id = 'id_group = ' . $_GET['id_edit'];
        $number = trim($_POST['number']);
        $course = trim($_POST['id_course']);
        $teacher = trim($_POST['id_teacher']);
        if ($number === '' || $course === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (iconv_strlen($number) > 5) {
            $error = 'Слишком длинный номер группы!';
        } else {
            $post = [
                'number' => $number,
                'id_course' => $course,
                'id_teacher' => $teacher,
            ];
            updateRow('groups', $id, $post);
            header('location: ' . 'index.php');
        }
    }
    //hz
}
