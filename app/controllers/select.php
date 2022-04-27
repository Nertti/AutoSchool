<?php
$teachers = selectALL('teachers');
$admins = selectALL('admins');
$students = selectALL('students');
//$students = selectALL('students+group');//view
$groups = selectALL('groups');
//$groups = selectALL('groups+category');//view
$lessons = selectALL('lessons');
$cabinets = selectALL('cabinets');
