-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 03 2022 г., 19:39
-- Версия сервера: 8.0.27
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auto`
--
CREATE DATABASE IF NOT EXISTS `auto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `auto`;

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_lessons_on_teacher` (IN `id_group` INT, IN `date_start` DATE, IN `date_end` DATE, IN `id_teacher` INT)  BEGIN

SELECT l.*, c.number, t.surname, t.name AS 'name_t', t.last_name FROM `lessons` l
JOIN `cabinets` c ON l.id_cabinet = c.id_cabinet
JOIN `teachers` t ON l.id_teacher = t.id_teacher
WHERE l.id_group = id_group and l.date >= date_start and l.date <= date_end and l.id_teacher = id_teacher
ORDER BY l.date;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_lesson_on_group` (IN `id_group` INT, IN `date_start` DATE, IN `date_end` DATE)  BEGIN

SELECT l.*, c.number, t.surname, t.name AS 'name_t', t.last_name FROM `lessons` l
JOIN `cabinets` c ON l.id_cabinet = c.id_cabinet
JOIN `teachers` t ON l.id_teacher = t.id_teacher
WHERE l.id_group = id_group and l.date >= date_start and l.date <= date_end
ORDER BY l.date;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_lesson_on_teach` (IN `id_teacher` INT, IN `date_start` DATE, IN `date_end` DATE)  BEGIN

SELECT l.* FROM `lessons` l
WHERE l.id_teacher = id_teacher and l.date >= date_start and l.date <= date_end;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_students` (IN `groupID` INT)  BEGIN
SELECT * FROM `students` S
WHERE S.id_group = groupID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_timeteacher` (IN `id_teacher` INT)  BEGIN

SELECT t.*, w.time FROM time_work w
JOIN teachers t on w.id_time_work = t.id_time_work
WHERE t.id_teacher = id_teacher;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `report_group` (IN `date_start` DATE, IN `date_end` DATE)  BEGIN

SELECT g.id_group, g.number, COUNT(l.id_lesson) as 'count' FROM `groups` g
LEFT JOIN lessons L on g.id_group = L.id_group
WHERE L.date BETWEEN date_start and date_end
GROUP BY G.id_group, g.number;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `report_teacher` (IN `date_start` DATE, IN `date_end` DATE)  BEGIN

SELECT T.id_teacher, T.surname, T.name, T.last_name, IFNULL(COUNT(L.id_lesson),0) as 'count' FROM teachers T 
LEFT JOIN lessons L on T.id_teacher = L.id_teacher
WHERE L.date BETWEEN date_start and date_end
GROUP BY T.id_teacher, T.surname, T.name, T.last_name;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id_admin` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id_admin`, `name`, `login`, `password`) VALUES
(1, 'Даниил', 'root', '$2y$10$f3OvHTp4k6ymLYLENPlxhOFtoNbMrRIF4GAWEGQDqNSg4Yx1USmeG');

-- --------------------------------------------------------

--
-- Структура таблицы `cabinets`
--

CREATE TABLE `cabinets` (
  `id_cabinet` int NOT NULL,
  `number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cabinets`
--

INSERT INTO `cabinets` (`id_cabinet`, `number`) VALUES
(1, 101),
(2, 102),
(3, 103),
(4, 104),
(5, 105),
(6, 106),
(7, 107),
(8, 108),
(9, 201),
(10, 202),
(11, 203),
(12, 204),
(13, 205),
(14, 206),
(15, 207);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int NOT NULL,
  `name` varchar(5) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `name`) VALUES
(1, 'A'),
(3, 'A1'),
(2, 'B'),
(6, 'BE'),
(4, 'C'),
(7, 'CE'),
(5, 'D'),
(8, 'DE');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id_group` int NOT NULL,
  `number` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `count_students` int DEFAULT NULL,
  `id_category` int NOT NULL,
  `id_time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id_group`, `number`, `count_students`, `id_category`, `id_time`) VALUES
(29, '156', 15, 1, 3),
(30, '963', 13, 7, 3),
(31, '0001', 22, 1, 4),
(32, '213', 22, 4, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `historykursants`
--

CREATE TABLE `historykursants` (
  `IdHistoryKursants` int NOT NULL,
  `FIO` int NOT NULL,
  `Phone` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DateStart` date NOT NULL,
  `DateFinish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id_lesson` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `id_cabinet` int NOT NULL,
  `id_group` int NOT NULL,
  `id_teacher` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id_lesson`, `name`, `date`, `id_cabinet`, `id_group`, `id_teacher`) VALUES
(11, '11', '2022-06-01', 1, 29, 7),
(14, 'Kalia Lane', '2022-06-02', 1, 30, 9),
(16, 'Anastasia Hensley', '2022-06-03', 7, 30, 7),
(17, 'Kylie Massey', '1970-07-22', 10, 30, 9),
(19, 'Kelsie Rosa', '2022-06-11', 7, 31, 7),
(20, 'Leigh Christian', '2022-06-04', 13, 31, 9),
(21, 'Camilla Cervantes', '2022-06-03', 1, 29, 9),
(22, 'Ariel Campos', '2022-06-09', 7, 30, 9),
(23, 'Inga Gould', '2022-05-20', 6, 29, 9);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `select_groups`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `select_groups` (
`id_group` int
,`count_students` int
,`number` varchar(5)
,`time` varchar(30)
,`name` varchar(5)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `select_lessons`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `select_lessons` (
`id_lesson` int
,`theme` varchar(30)
,`date` date
,`id_cabinet` int
,`number` int
,`group` varchar(5)
,`time` varchar(30)
,`id_teacher` int
,`surname` varchar(30)
,`name` varchar(30)
,`last_name` varchar(30)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `select_students`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `select_students` (
`id_student` int
,`surname` varchar(30)
,`name` varchar(30)
,`last_name` varchar(50)
,`phone` varchar(13)
,`passport` varchar(9)
,`date_start` date
,`id_group` int
,`number` varchar(5)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `select_students_null`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `select_students_null` (
`id_student` int
,`surname` varchar(30)
,`name` varchar(30)
,`last_name` varchar(50)
,`phone` varchar(13)
,`passport` varchar(9)
,`date_start` date
,`id_group` int
);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id_student` int NOT NULL,
  `surname` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `passport` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_start` date NOT NULL,
  `id_group` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id_student`, `surname`, `name`, `last_name`, `phone`, `passport`, `date_start`, `id_group`) VALUES
(12, 'Шамшуров', 'Денис', 'Иванович', '+375293420001', NULL, '2022-05-20', NULL),
(13, 'Говако', 'Константин', 'Сергеевич', '+375333101000', 'MP5553444', '2022-05-20', NULL),
(14, 'Неретин', 'Даниил', 'Александрович', '+375445753201', NULL, '2022-05-20', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `id_teacher` int NOT NULL,
  `surname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_time_work` int DEFAULT NULL,
  `passport` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id_teacher`, `surname`, `name`, `last_name`, `id_time_work`, `passport`, `phone`, `login`, `password`) VALUES
(7, 'Кулак', 'Вадим', 'Михайлович', 1, '', '+375333505052', 'Quia', '$2y$10$kDRO.3cgw7XLjzJj2hG78uH/yiYz6/N.5dRhRBZvQ6XXm13MIrplG'),
(9, 'Гузик', 'Денис', 'Александрович', 2, '', '+375445750000', 'teacher', '$2y$10$m3ITizK4G0z4QSUoTcamdO94Xj5MVN39226OUj1DVdrXn2JtKg6Gm');

-- --------------------------------------------------------

--
-- Структура таблицы `time_group`
--

CREATE TABLE `time_group` (
  `id_time_group` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `time_group`
--

INSERT INTO `time_group` (`id_time_group`, `name`) VALUES
(3, 'вечерняя'),
(4, 'выходная'),
(2, 'дневная');

-- --------------------------------------------------------

--
-- Структура таблицы `time_work`
--

CREATE TABLE `time_work` (
  `id_time_work` int NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `time_work`
--

INSERT INTO `time_work` (`id_time_work`, `name`, `time`) VALUES
(1, 'Полставки', 8),
(2, 'Ставка', 16);

-- --------------------------------------------------------

--
-- Структура для представления `select_groups`
--
DROP TABLE IF EXISTS `select_groups`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `select_groups`  AS SELECT `g`.`id_group` AS `id_group`, `g`.`count_students` AS `count_students`, `g`.`number` AS `number`, `t`.`name` AS `time`, `c`.`name` AS `name` FROM ((`groups` `g` join `categories` `c` on((`g`.`id_category` = `c`.`id_category`))) join `time_group` `t` on((`g`.`id_time` = `t`.`id_time_group`))) ;

-- --------------------------------------------------------

--
-- Структура для представления `select_lessons`
--
DROP TABLE IF EXISTS `select_lessons`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `select_lessons`  AS SELECT `l`.`id_lesson` AS `id_lesson`, `l`.`name` AS `theme`, `l`.`date` AS `date`, `c`.`id_cabinet` AS `id_cabinet`, `c`.`number` AS `number`, `g`.`number` AS `group`, `tg`.`name` AS `time`, `t`.`id_teacher` AS `id_teacher`, `t`.`surname` AS `surname`, `t`.`name` AS `name`, `t`.`last_name` AS `last_name` FROM ((((`lessons` `l` join `cabinets` `c` on((`c`.`id_cabinet` = `l`.`id_cabinet`))) join `groups` `g` on((`g`.`id_group` = `l`.`id_group`))) join `teachers` `t` on((`t`.`id_teacher` = `l`.`id_teacher`))) join `time_group` `tg` on((`tg`.`id_time_group` = `g`.`id_time`))) ;

-- --------------------------------------------------------

--
-- Структура для представления `select_students`
--
DROP TABLE IF EXISTS `select_students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `select_students`  AS SELECT `s`.`id_student` AS `id_student`, `s`.`surname` AS `surname`, `s`.`name` AS `name`, `s`.`last_name` AS `last_name`, `s`.`phone` AS `phone`, `s`.`passport` AS `passport`, `s`.`date_start` AS `date_start`, `s`.`id_group` AS `id_group`, `g`.`number` AS `number` FROM (`students` `s` left join `groups` `g` on((`s`.`id_group` = `g`.`id_group`))) ;

-- --------------------------------------------------------

--
-- Структура для представления `select_students_null`
--
DROP TABLE IF EXISTS `select_students_null`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `select_students_null`  AS SELECT `students`.`id_student` AS `id_student`, `students`.`surname` AS `surname`, `students`.`name` AS `name`, `students`.`last_name` AS `last_name`, `students`.`phone` AS `phone`, `students`.`passport` AS `passport`, `students`.`date_start` AS `date_start`, `students`.`id_group` AS `id_group` FROM `students` WHERE (`students`.`id_group` is null) ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `cabinets`
--
ALTER TABLE `cabinets`
  ADD PRIMARY KEY (`id_cabinet`),
  ADD UNIQUE KEY `UQ_NameClass` (`number`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id_group`),
  ADD UNIQUE KEY `UQ_CountKursant` (`number`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_time` (`id_time`);

--
-- Индексы таблицы `historykursants`
--
ALTER TABLE `historykursants`
  ADD PRIMARY KEY (`IdHistoryKursants`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id_lesson`),
  ADD KEY `FK_IdClassLesson` (`id_cabinet`),
  ADD KEY `FK_IdGroupLesson` (`id_group`),
  ADD KEY `id_teacher` (`id_teacher`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `passport` (`passport`),
  ADD KEY `id_group` (`id_group`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id_teacher`),
  ADD UNIQUE KEY `UQ_Phone` (`phone`),
  ADD UNIQUE KEY `UQ_login` (`login`),
  ADD KEY `id_time_work` (`id_time_work`);

--
-- Индексы таблицы `time_group`
--
ALTER TABLE `time_group`
  ADD PRIMARY KEY (`id_time_group`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `time_work`
--
ALTER TABLE `time_work`
  ADD PRIMARY KEY (`id_time_work`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cabinets`
--
ALTER TABLE `cabinets`
  MODIFY `id_cabinet` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id_group` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `historykursants`
--
ALTER TABLE `historykursants`
  MODIFY `IdHistoryKursants` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id_lesson` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id_teacher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `time_group`
--
ALTER TABLE `time_group`
  MODIFY `id_time_group` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `time_work`
--
ALTER TABLE `time_work`
  MODIFY `id_time_work` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`id_time`) REFERENCES `time_group` (`id_time_group`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `FK_IdClassLesson` FOREIGN KEY (`id_cabinet`) REFERENCES `cabinets` (`id_cabinet`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_IdGroupLesson` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `teachers` (`id_teacher`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`id_time_work`) REFERENCES `time_work` (`id_time_work`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
