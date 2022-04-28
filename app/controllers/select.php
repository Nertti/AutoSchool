<?php
$teachers = selectALL('teachers');
$admins = selectALL('admins');
$students = selectALL('students');
//$students = selectALL('students+group');//view
$groups = selectALL('groups');
$groupsVIEW = selectALL('select_groups');//view
$lessons = selectALL('lessons');
$cabinets = selectALL('cabinets');
$categories = selectALL('categories');
