--
-- Структура таблицы `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `idAppointment` int(6) unsigned NOT NULL,
  `idRoom` int(6) unsigned NOT NULL,
  `idRecurring` int(6) unsigned DEFAULT NULL,
  `idEmployee` int(6) unsigned DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` time NOT NULL,
  `End` time NOT NULL,
  `Description` text NOT NULL,
  `Submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`idAppointment`, `idRoom`, `idRecurring`, `idEmployee`, `Date`, `Start`, `End`, `Description`, `Submitted`) VALUES
(8, 1, NULL, NULL, '2015-04-13', '06:00:00', '08:00:00', '', '2015-04-21 06:29:25'),
(9, 1, 9, NULL, '2015-04-13', '09:00:00', '11:00:00', '', '2015-04-21 06:29:25'),
(10, 1, 9, NULL, '2015-04-20', '09:00:00', '11:00:00', '', '2015-04-21 06:29:25'),
(13, 1, 13, 4, '2015-04-15', '12:00:00', '15:00:00', '', '2015-04-21 06:29:25'),
(18, 2, 17, NULL, '2015-04-23', '11:00:00', '14:00:00', 'qwe', '2015-04-21 06:29:25'),
(19, 2, 17, NULL, '2015-04-30', '11:00:00', '14:00:00', 'qwe', '2015-04-21 06:29:25'),
(20, 2, 17, NULL, '2015-05-07', '11:00:00', '14:00:00', 'asdasd', '2015-04-21 06:29:25'),
(35, 1, 35, 4, '2015-03-04', '05:00:00', '06:00:00', 'fedfwe', '2015-04-21 06:29:25'),
(36, 1, 35, 4, '2015-04-06', '05:00:00', '06:00:00', 'fedfwe', '2015-04-21 06:29:25'),
(37, 1, NULL, NULL, '2015-04-21', '01:00:00', '03:00:00', 'gvbtrf', '2015-04-21 06:29:25'),
(40, 1, NULL, 4, '2015-04-21', '18:15:00', '19:00:00', 'efwe', '2015-04-21 15:08:13'),
(50, 1, 46, NULL, '2015-06-01', '19:00:00', '20:00:00', 'dfger', '2015-04-21 16:04:41'),
(51, 1, 51, 4, '2015-04-22', '11:00:00', '12:30:00', 'asdasdsadwq', '2015-04-22 07:39:56'),
(71, 1, 71, 4, '2015-04-22', '19:00:00', '22:30:00', 'qweasd', '2015-04-22 07:44:34'),
(75, 1, 71, NULL, '2015-05-20', '19:00:00', '21:00:00', 'qwqwe', '2015-04-22 07:44:34'),
(76, 1, 76, 4, '2015-04-24', '19:00:00', '20:00:00', 'tgrt5', '2015-04-23 16:08:01'),
(77, 1, 76, 4, '2015-05-25', '19:00:00', '20:00:00', 'tgrt5', '2015-04-23 16:08:01'),
(78, 1, NULL, 4, '2015-04-30', '19:00:00', '20:00:00', 'ertgr', '2015-04-23 16:09:38'),
(79, 1, 79, 4, '2015-04-27', '19:00:00', '20:00:00', 'qweq', '2015-04-23 16:13:24'),
(80, 1, 79, 4, '2015-05-04', '19:00:00', '20:00:00', 'qweq', '2015-04-23 16:13:24'),
(81, 1, 79, 4, '2015-05-11', '19:00:00', '20:00:00', 'qweq', '2015-04-23 16:13:24'),
(82, 1, 79, 4, '2015-05-18', '19:00:00', '20:00:00', 'qweq', '2015-04-23 16:13:24'),
(83, 1, NULL, 10, '2015-04-24', '20:00:00', '20:45:00', '', '2015-04-25 10:27:43'),
(84, 1, NULL, 4, '2015-04-28', '13:00:00', '14:00:00', 'fghtrfh', '2015-04-25 10:52:34'),
(90, 1, 90, 4, '2015-04-29', '13:00:00', '14:00:00', 'dfgre', '2015-04-25 10:58:40'),
(91, 1, 90, 4, '2015-05-06', '13:00:00', '14:00:00', 'dfgre', '2015-04-25 10:58:40'),
(92, 1, 92, 4, '2015-04-30', '13:00:00', '14:00:00', 'dgbr', '2015-04-26 10:21:01'),
(93, 1, 92, 4, '2015-06-01', '13:00:00', '14:00:00', 'dgbr', '2015-04-26 10:21:01'),
(94, 1, 94, 4, '2015-04-27', '15:00:00', '16:00:00', 'fghthrtyht', '2015-04-26 12:46:48'),
(95, 1, 94, 4, '2015-05-04', '15:00:00', '16:00:00', 'fghthrtyht', '2015-04-26 12:46:48'),
(96, 1, 94, 4, '2015-05-11', '15:00:00', '16:00:00', 'fghthrtyht', '2015-04-26 12:46:48'),
(97, 1, 94, 4, '2015-05-18', '15:00:00', '16:00:00', 'fghthrtyht', '2015-04-26 12:46:48'),
(98, 1, 94, 4, '2015-05-25', '15:00:00', '16:00:00', 'fghthrtyht', '2015-04-26 12:46:48'),
(99, 1, 99, 4, '2015-04-27', '09:45:00', '10:30:00', 'ghj', '2015-04-26 12:48:15'),
(100, 1, 99, 4, '2015-05-11', '09:45:00', '10:30:00', 'ghj', '2015-04-26 12:48:15'),
(109, 1, 109, 4, '2015-04-27', '22:15:00', '23:45:00', 'ghjhjg', '2015-04-26 12:54:41'),
(110, 1, 109, 4, '2015-05-11', '22:15:00', '23:45:00', 'ghjhjg', '2015-04-26 12:54:41'),
(111, 1, 109, 4, '2015-05-25', '22:15:00', '23:45:00', 'ghjhjg', '2015-04-26 12:54:42'),
(112, 1, 112, 4, '2015-04-27', '11:00:00', '13:00:00', 'asd', '2015-04-26 12:57:45'),
(113, 1, 112, 4, '2015-05-27', '11:00:00', '13:00:00', 'asd', '2015-04-26 12:57:45');

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `idEmployee` int(6) unsigned NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `SessionId` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`idEmployee`, `Name`, `Email`, `Password`, `IsAdmin`, `SessionId`) VALUES
(4, 'Max Boss', 'max@i.ua', '*A4B6157319038724E3560894F7F932C8886EBFCF', 1, 'ib0fodcgsqdl5ihrf02hlttg70'),
(10, 'Andrew', 'andr@i.ua', '*A4B6157319038724E3560894F7F932C8886EBFCF', 1, NULL),
(11, 'Ashot', 'ashot@i.ua', '*A4B6157319038724E3560894F7F932C8886EBFCF', 0, 'ib0fodcgsqdl5ihrf02hlttg70');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `idRoom` int(6) unsigned NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`idRoom`, `Name`) VALUES
(1, 'room 1'),
(2, 'room 2'),
(3, 'palace');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`idAppointment`),
  ADD KEY `idRoom` (`idRoom`),
  ADD KEY `idEmployee` (`idEmployee`),
  ADD KEY `idRecurring` (`idRecurring`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`idEmployee`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`idRoom`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointments`
--
ALTER TABLE `appointments`
  MODIFY `idAppointment` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `idEmployee` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `idRoom` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`idRoom`) REFERENCES `rooms` (`idRoom`) ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`idEmployee`) REFERENCES `employees` (`idEmployee`) ON DELETE SET NULL ON UPDATE CASCADE;