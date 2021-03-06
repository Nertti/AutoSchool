<?php
$day_of_week = [
    'Понедельник',
    'Вторник',
    'Среда',
    'Четверг',
    'Пятница',
    'Суббота',
];
$period = new DatePeriod(
    new DateTime(date('Y-m-d', strtotime('monday this week'))),
    new DateInterval('P1D'),
    (new DateTime(date('Y-m-d', strtotime('saturday this week'))))->modify('+1 day') // +1 day нужен так как конец не входит в интервал
);
$week = [];
foreach( $period as $date) {
    $week[] = $date->format('d.m');
}
$next_period = new DatePeriod(
    new DateTime(date('Y-m-d', strtotime('monday next week'))),
    new DateInterval('P1D'),
    (new DateTime(date('Y-m-d', strtotime('saturday next week'))))->modify('+1 day') // +1 day нужен так как конец не входит в интервал
);
$next_week = [];
foreach( $next_period as $date) {
    $next_week[] = $date->format('d.m');
}