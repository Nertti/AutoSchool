<?php
session_start();
require('connect.php');

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}

//проверка на ошибки
function checkErrors($query)
{
    $errInfo = $query->errorInfo();

    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
}

function selectOne($table, $params = [])
{
    global $pdo;

    $sql = "select * from `$table`";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {

            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetch();
}

function selectALL($table, $params = [])
{
    global $pdo;

    $sql = "select * from `$table`";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {

            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetchAll();
}

function selectOrder($table, $sort_sql, $params = [])
{
    global $pdo;

    $sql = "select * from `$table`";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            //массив ассоциативный наоборот
            $value = "`" . $value . "`";
            $key = "'" . $key . "'";
            if ($i === 0) {
                $sql = $sql . " WHERE $value >= $key";
            } else {
                $sql = $sql . " AND $value <= $key";
            }
            $i++;
        }
    }
    $sql = $sql . " ORDER BY $sort_sql";
//    tt($sql);
    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);

    return $query->fetchAll();
}

function selectFind($table, $find_sql, $column, $params = [])
{
    global $pdo;

    $sql = "select * from `$table`";

    if (!empty($params)) {
        $sql = $sql . " AND $column LIKE '%" . $find_sql . "%'";
    } else {
        $sql = $sql . " WHERE $column LIKE '%" . $find_sql . "%'";
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetchAll();
}

//insert
function insertRow($table, $params)
{
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            if($value === 'NULL'){
                $coll = $coll . "$key";
                $mask = $mask . $value;
            }else{
                $coll = $coll . "$key";
                $mask = $mask . " '" . "$value" . "'";
            }
        } else {
            if($value === 'NULL'){
                $coll = $coll . ", $key";
                $mask = $mask . "," . $value;
            }else{
                $coll = $coll . ", $key";
                $mask = $mask . "," . " '" . "$value" . "'";
            }
        }
        $i++;
    }

    $sql = "INSERT INTO `$table`($coll) VALUES ($mask)";
//    tt($sql);
    $query = $pdo->prepare($sql);
    $query->execute($params);

    checkErrors($query);

    return $pdo->lastInsertId();
}

function updateRow($table, $id, $params)
{
    global $pdo;
    $i = 0;
    $str = '';

    foreach ($params as $key => $value) {
        if ($i === 0) {
            if($value === 'NULL'){
                $str = $str . $key . " = " . $value;
            }else{
                $str = $str . $key . " = '" . $value . "'";
            }
        } else {
            if($value === 'NULL'){
                $str = $str . $key . " = " . $value;
            }else{
                $str = $str . ", " . $key . " = '" . $value . "'";
            }
        }
        $i++;
    }

    $sql = "UPDATE `$table` SET $str WHERE $id";
    $query = $pdo->prepare($sql);
    $query->execute($params);

    checkErrors($query);
}

function deleteRow($table, $id)
{
    global $pdo;

    $sql = "DELETE FROM `$table` WHERE $id";
    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);
}

function callProc ($nameProc, $param=[])
{
    global $pdo;
    $sql = "CALL `$nameProc` ($param)";
//    tt($sql);
    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetchAll();
}
function report ($table = '')
{
    global $pdo;
    $sql = '';
    if($table == 'students'){
        $sql = "SELECT COUNT(s.id_student) as 'count' FROM `students` s";
    } elseif ($table == 'teachers') {
        $sql = "SELECT COUNT(s.id_teacher) as 'count' FROM `teachers` s";
    } elseif ($table == 'groups') {
        $sql = "SELECT COUNT(s.id_group) as 'count' FROM `groups` s";
    }
    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetch();
}

function sort_link_bar($title, $a, $b, $table)
{
    $sort = @$_GET['sort'];
    if ($sort == $a) {
        return ' active" href="?sort=' . $b . '&table=' . $table . '">' . $title . ' <i class="arrow">↑</i>';
    } elseif ($sort == $b) {
        return ' active" href="?sort=' . $a . '&table=' . $table . '">' . $title . ' <i class="arrow">↓</i>';
    } else {
        return '" href="?sort=' . $a . '&table=' . $table . ' ">' . $title ;
    }
}
