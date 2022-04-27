<?php
//регистрация пользователя в какую либо из таблиц()
//if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rr'])) {
//    $name = trim($_POST['name']);
////    $surname = trim($_POST['surname']);
////    $last_name = trim($_POST['last_name']);
//    $login = trim($_POST['login']);
//    $pass = trim($_POST['password']);
////    $check_pass = trim($_POST['check_pass']);
//    if ($name === '' || $login === '' || $pass === '') {
//        $error = 'Одно из полей пустое';
//    } else {
//        $pass = password_hash($pass, PASSWORD_DEFAULT);
//        $post = [
//            'name' => $name,
////            'surname' => $surname,
////            'last_name' => $last_name,
//            'login' => $login,
//            'password' => $pass,
//        ];
//        $id = insertRow('admins', $post);
////        header('location: ' . 'admin/admin.php');
//    }
//}
//авторизация созданного пользователя
function userAuth($user)
{

    if (isset($user['id_admin'])) {
        $_SESSION['id_admin'] = $user['id_admin'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['pass'] = $user['password'];

        header('location: ' . 'admin/admin.php');

    } else if (isset($user['id_teacher'])) {
        $_SESSION['id_teacher'] = $user['id_teacher'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['surname'] = $user['surname'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['pass'] = $user['password'];

        header('location: ' . 'teacher/teacher');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-btn'])) {
    $login = trim($_POST['login']);
    $pass = trim($_POST['password']);
    if ($login === '' || $pass === '') {
        $error = 'Одно из полей незаполнено!';
    } else {
        $teachers = selectOne('teachers', ['login' => $login]);
        $admins = selectOne('admins', ['login' => $login]);
        if ($teachers && password_verify($pass, $teachers['password'])) {
            echo 'good';
            userAuth($teachers);
        } else if ($admins && password_verify($pass, $admins['password'])) {
            echo 'good';
            userAuth($admins);
        } else {
            $error = 'Неверный логин или пароль';
        }
    }
}
