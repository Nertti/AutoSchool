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
        $check_phone = selectOne($table, ['phone' => $phone]);
        if ($name === '' || $surname === '' || $phone === '') {
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
        } elseif ($check_phone['phone'] === $phone) {
            $error = 'Такой телефон уже зарегистрирован';
        } elseif ($passport != '') {
            $check_passport_teacher = selectOne('teachers', ['passport' => $passport]);
            if (!$check_passport_teacher == '') {
                $error = 'Такой паспорт уже зарегистрирован';
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
    //ok//
    if ($table === 'teachers') {
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $pass = trim($_POST['password']);
        $phone = str_replace([' ', '(', ')', '-',], '', trim($_POST['phone']));
        $passport = trim($_POST['passport']);
        $id_time_work = trim($_POST['id_time_work']);
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
                        'id_time_work' => $id_time_work,
                    ];
                    $id = insertRow($table, $post);
                    header('location: ' . 'index.php');
                }
            }
        }
    }
    //ok//
    if ($table === 'groups') {
        $number = trim($_POST['number']);
        $category = trim($_POST['id_category']);
        $time = trim($_POST['id_time_group']);
        $count = trim($_POST['count']);
        if ($number === '' || $category === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (iconv_strlen($number) > 5) {
            $error = 'Слишком длинный номер группы!';
        } elseif ($count > 30) {
            $error = 'Слишком длинный номер группы!';
        } else {
            $check_number = selectOne($table, ['number' => $number]);
            if ($check_number['number'] === $number) {
                $error = 'Такая группа уже существует';
            } else {
                $post = [
                    'number' => $number,
                    'id_category' => $category,
                    'id_time' => $time,
                    'count_students' => $count,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    // ok + front
    if ($table === 'lessons') {
        $name = trim($_POST['name']);
        $date = trim($_POST['date']);
        $group = trim($_POST['id_group']);
        $teacher = trim($_POST['id_teacher']);
        $cabinet = trim($_POST['id_cabinet']);

        $group_number = selectOne('select_groups', ['id_group' => $group]);
        $this_lesson_group = selectOne('lessons', [
            'id_group' => $group,
            'date' => $date,
        ]);
        $this_lesson_time = selectOne('select_lessons', [
            'date' => $date,
            'time' => $group_number['time'],
        ]);
        $this_lesson_time_teacher = selectOne('select_lessons', [
            'date' => $date,
            'time' => $group_number['time'],
            'id_teacher' => $teacher,
        ]);
        $this_lesson_time_cabinet = selectOne('select_lessons', [
            'date' => $date,
            'time' => $group_number['time'],
            'id_cabinet' => $cabinet,
        ]);
        $lessons_on_teach = callProc('proc_lesson_on_teach',
            $teacher . ', "' .
            date('Y-m-d', strtotime('monday this week', strtotime($date))) . '","' .
            date('Y-m-d', strtotime('saturday this week', strtotime($date))) . '"');

        $time = callProc('proc_timeteacher', $teacher);
        $timeOne = $time['0'];
        if (count($lessons_on_teach) * 2 > $timeOne['time']) {
            $error = 'Количество часов в неделю преподавателя превышено';
        } elseif ($group === '' || $date == '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (!$this_lesson_group == '') {
            $error = 'Урок у этой группы в этот день уже есть';
        } elseif (!$this_lesson_time_teacher == '') {
            $error = 'Урок у этого преподавателя в это время уже есть';
        } elseif (!$this_lesson_time_cabinet == '') {
            $error = 'Урок в кабинета в это время уже есть';
        } elseif ($date <= date('Y-m-d')) {
            $error = 'Нельзя назначить урок в предыдущую дату';
        } elseif ($group_number['time'] == 'выходная' && date('D', strtotime($date)) !== date('D', strtotime('saturday this week', strtotime($date)))) {
            $error = 'выбранная группа должна проводить занятия только в выходные';
        } elseif ($group_number['time'] != 'выходная' && date('D', strtotime($date)) == date('D', strtotime('saturday this week', strtotime($date)))) {
            $error = 'выбранная группа должна проводить занятия только в будние';
        } else {
            $post = [
                'name' => $name,
                'date' => $date,
                'id_cabinet' => $cabinet,
                'id_group' => $group,
                'id_teacher' => $teacher,
            ];
            $id = insertRow($table, $post);
            header('location: ' . 'index.php');
        }
    }

}
