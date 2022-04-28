<?php


$preg_phone = "/^\+375(25|29|33|44)[0-9]{7}$/";
$preg_passport = "/^[A-Z]{2}[0-9]{7}$/";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-add'])) {
    $table = trim($_POST['btn-add']);
    if ($table === 'students') {
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $phone = str_replace([' ', '(', ')', '-',], '', trim($_POST['phone']));
        $passport = trim($_POST['passport']);
        $today = date("Y-n-j");
        if ($name === '' || $surname === '' || $last_name === '' || $phone === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
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
            $check_phone = selectOne($table, ['phone' => $phone]);
            if ($check_phone['phone'] === $phone) {
                $error = 'Такой пользователь уже существует';
            } elseif ($passport != '') {
                $check_passport_student = selectOne($table, ['passport' => $passport]);
                if (!$check_passport_student == '') {
                    $error = 'Такой паспорт уже зарегистрирован';
                }
            } else {
                $post = [
                    'name' => $name,
                    'surname' => $surname,
                    'last_name' => $last_name,
                    'phone' => $phone,
                    'passport' => $passport,
                    'date_start' => $today,
                ];

                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    //ok
    if ($table === 'teachers') {
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $pass = trim($_POST['password']);
        $phone = str_replace([' ', '(', ')', '-',], '', trim($_POST['phone']));
        $passport = trim($_POST['passport']);
        if ($name === '' || $surname === '' || $login === '' || $pass === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля со звёздочкой';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($surname) > 50) {
            $error = 'Слишком длинная фамилия!';
        } elseif (iconv_strlen($last_name) > 50) {
            $error = 'Слишком длинное отчество!';
        } elseif (iconv_strlen($login) < 3 || iconv_strlen($login) > 15) {
            $error = 'Длина логина может быть от 3 до 15 символов!';
        } elseif (iconv_strlen($pass) < 6 || iconv_strlen($pass) > 20) {
            $error = 'Длина пароля должна быть от 6 до 20 символов!';
        } elseif (!preg_match($preg_phone, $phone) && !$phone == '') {
            $error = 'Введите верный телефон';
        } elseif (!preg_match($preg_passport, $passport) && $passport != '') {
            $error = 'Введите верный паспорт';
        } else {
            $check_login_teacher = selectOne('teachers', ['login' => $login]);
            $check_phone_teacher = selectOne('teachers', ['phone' => $phone]);
            if (!$check_phone_teacher == '') {
                $error = 'Такой телефон уже зарегистрирован';
            } elseif (!$check_login_teacher == '') {
                $error = 'Такой пользователь уже существует (преподаватель)';
            } elseif ($passport != '') {
                $check_passport_teacher = selectOne('teachers', ['passport' => $passport]);
                if (!$check_passport_teacher == '') {
                    $error = 'Такой паспорт уже зарегистрирован';
                }
            } else {

                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $post = [
                    'name' => $name,
                    'surname' => $surname,
                    'last_name' => $last_name,
                    'login' => $login,
                    'password' => $pass,
                    'phone' => $phone,
                    'passport' => $passport,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    //ok
    if ($table === 'groups') {
        $number = trim($_POST['number']);
        $category = trim($_POST['id_category']);
        $teacher = trim($_POST['id_teacher']);
        if ($number === '' || $category === '' || $teacher === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (iconv_strlen($number) > 5) {
            $error = 'Слишком длинный номер группы!';
        } else {
            $check_number = selectOne($table, ['number' => $number]);
            if ($check_number['number'] === $number) {
                $error = 'Такая группа уже существует';
            } else {
                $post = [
                    'number' => $number,
                    'id_category' => $category,
                    'id_teacher' => $teacher,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    // ok + front
    if ($table === 'lessons') {
        $group = trim($_POST['id_group']);
        $date = trim($_POST['date']);
        $time_start = trim($_POST['time_start']);
        $time_end = trim($_POST['time_end']);
        if ($group === '' || $time_start === '' || $date == '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } else {
            $post = [
                'date' => $date,
                'time_start' => $time_start,
                'time_end' => $time_end,
                'id_group' => $group,
            ];
            $id = insertRow($table, $post);
            header('location: ' . 'index.php');
        }
    }

}
