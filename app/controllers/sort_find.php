<?php
$find_sql = '';
$sort_list = [
    'id_asc' => 'id_student',
    'id_desc' => 'id_student DESC',
    'surname_asc' => 'surname',
    'surname_desc' => 'surname DESC',
    'group_name_asc' => 'number',
    'group_name_desc' => 'number DESC',


    'number_asc' => 'number',
    'number_desc' => 'number DESC',
    'category_asc' => 'name',
    'category_desc' => 'name DESC',
];

$sort = @$_GET['sort'];
$table = @$_GET['table'];
if (array_key_exists($sort, $sort_list)) {
    $sort_sql = $sort_list[$sort];
} else {
    $sort_sql = reset($sort_list);
}
if(isset($_GET['sort'])){
    if ($table === 'students'){
        $studentsVIEW = selectOrder('select_students', $sort_sql);
    } elseif ($table === 'teachers'){
        $teachers = selectOrder('teachers', $sort_sql);
    } elseif ($table === 'groups'){
        $groupsVIEW = selectOrder('select_groups', $sort_sql);
    }
}

if (isset($_POST['find'])) {
    $table = $_POST['find'];
    $find_sql = $_POST['search'];
    if($table === 'select_students'){
        $studentsVIEW = selectFind($table, $find_sql, 'surname');
    }elseif ($table === 'teachers'){
        $teachers = selectFind($table, $find_sql, 'surname');
    }elseif ($table === 'select_groups'){
        $groupsVIEW = selectFind($table, $find_sql, 'number');
    }
}
if (isset($_POST['reset'])) {
    $table = $_POST['reset'];
    $studentsVIEW = selectALL($table);
    $teachers = selectALL($table);
    $groups = selectALL($table);
    $find_sql = '';
}
