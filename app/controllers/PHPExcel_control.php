<?php

if (isset($_GET['report_1'])) {

    $objPHPExel = new PHPExcel();

    $objPHPExel->setActiveSheetIndex(0);

    $activ_sheet = $objPHPExel->getActiveSheet();

    $activ_sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    $activ_sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

    $activ_sheet->setTitle('Занятость преподавателей');

    $activ_sheet->getColumnDimension('A')->setWidth(30);
    $activ_sheet->getColumnDimension('B')->setWidth(15);

    $activ_sheet->getRowDimension('1')->setRowHeight(20);

    $activ_sheet->setCellValueByColumnAndRow(0, 1, 'Занятость преподавателей за предыдущий месяц');
    $activ_sheet->setCellValueByColumnAndRow(0, 2, 'Фамилия И.О.');
    $activ_sheet->setCellValueByColumnAndRow(1, 2, 'Кол-во часов');

    $today = new DateTime('now');
    $month = $today->modify('-1 month')->format('F');
    $teachers = callProc('report_teacher',
        '"' . date('Y-m-d', strtotime("first day of $month")) . '", "' .
        date('Y-m-d', strtotime("last day of $month")) . '"');
    $teachersNULL = selectALL('teachers');
    foreach ($teachersNULL as $key => $teacherNULL) {
        foreach ($teachers as $key2 => $teacher) {
            if ($teacherNULL['id_teacher'] == $teacher['id_teacher']) {
                unset($teachersNULL[$key]);
                echo $key;
            }
        }
    }
    $count = 3;
    foreach ($teachers as $key => $teacher) {
        $activ_sheet->setCellValue("A$count", $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['last_name']);
        $activ_sheet->setCellValue("B$count", $teacher['count']);
        $count++;
    }
    foreach ($teachersNULL as $key => $teacherNULL) {
        $activ_sheet->setCellValue("A$count", $teacherNULL['surname'] . ' ' . $teacherNULL['name'] . ' ' . $teacherNULL['last_name']);
        $activ_sheet->setCellValue("B$count", 0);
        $count++;
    }

    $filename = 'report.xlsx';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExel, 'Excel2007');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $objWriter->save($filename);
    function file_force_download($filename)
    {
        if (file_exists($filename)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            // читаем файл и отправляем его пользователю
            readfile($filename);
            exit;
        }
    }

    file_force_download($filename);
}
if (isset($_GET['report_2'])) {

    $objPHPExel = new PHPExcel();

    $objPHPExel->setActiveSheetIndex(0);

    $activ_sheet = $objPHPExel->getActiveSheet();

    $activ_sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    $activ_sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

    $activ_sheet->setTitle('Занятия у групп');

    $activ_sheet->getColumnDimension('A')->setWidth(30);
    $activ_sheet->getColumnDimension('B')->setWidth(15);

    $activ_sheet->getRowDimension('1')->setRowHeight(20);

    $activ_sheet->setCellValueByColumnAndRow(0, 1, 'Кол-во занятий у групп за предыдущий месяц');
    $activ_sheet->setCellValueByColumnAndRow(0, 2, 'Номер группы');
    $activ_sheet->setCellValueByColumnAndRow(1, 2, 'Кол-во занятий');

    $today = new DateTime('now');
    $month = $today->modify('-1 month')->format('F');
    $groups = callProc('report_group',
        '"' . date('Y-m-d', strtotime("first day of $month")) . '", "' .
        date('Y-m-d', strtotime("last day of $month")) . '"');
    $count = 3;
    $groupsNULL = selectALL('groups');
    foreach ($groupsNULL as $key => $groupNULL) {
        foreach ($groups as $key2 => $group) {
            if ($groupNULL['id_group'] == $group['id_group']) {
                unset($groupsNULL[$key]);
                echo $key;
            }
        }
    }

    foreach ($groups as $key => $group) {
        $activ_sheet->setCellValue("A$count", $group['number']);
        $activ_sheet->setCellValue("B$count", $group['count']);
        $count++;
    }
    foreach ($groupsNULL as $key => $groupNULL) {
        $activ_sheet->setCellValue("A$count", $groupNULL['number']);
        $activ_sheet->setCellValue("B$count", 0);
        $count++;
    }

    $filename = 'report2.xlsx';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExel, 'Excel2007');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $objWriter->save($filename);
    function file_force_download($filename)
    {
        if (file_exists($filename)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            // читаем файл и отправляем его пользователю
            readfile($filename);
            exit;
        }
    }

    file_force_download($filename);
}
if (isset($_GET['report_3'])) {

    $objPHPExel = new PHPExcel();

    $objPHPExel->setActiveSheetIndex(0);

    $activ_sheet = $objPHPExel->getActiveSheet();

    $activ_sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    $activ_sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

    $activ_sheet->setTitle('Посещаемость учащихся');

    $activ_sheet->getColumnDimension('A')->setWidth(40);
    $activ_sheet->getColumnDimension('B')->setWidth(35);

    $activ_sheet->getRowDimension('1')->setRowHeight(20);

    $activ_sheet->setCellValueByColumnAndRow(0, 1, 'Посещаемость учащихся за предыдущий месяц');
    $activ_sheet->setCellValueByColumnAndRow(0, 2, 'Фамилия И.О.');
    $activ_sheet->setCellValueByColumnAndRow(1, 2, 'Дата начала обучения');

    $today = new DateTime('now');
    $month = $today->modify('-1 month')->format('F');
    $students = selectALL('students');
    $count = 3;


    foreach ($students as $key => $student) {
        $activ_sheet->setCellValue("A$count", $student['surname'] . ' ' . $student['name'] . ' ' . $student['last_name']);
        $activ_sheet->setCellValue("B$count", $student['date_start']);
        $count++;
    }

    $filename = 'report3.xlsx';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExel, 'Excel2007');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $objWriter->save($filename);
    function file_force_download($filename)
    {
        if (file_exists($filename)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            // читаем файл и отправляем его пользователю
            readfile($filename);
            exit;
        }
    }

    file_force_download($filename);
}