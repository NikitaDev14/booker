SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

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
(82, 1, 79, 4, '2015-05-18', '19:00:00', '20:00:00', 'qweq', '2015-04-23 16:13:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`idEmployee`, `Name`, `Email`, `Password`, `IsAdmin`, `SessionId`) VALUES
(4, 'Asd Zxc qwe', 'max@i.ua', '*A4B6157319038724E3560894F7F932C8886EBFCF', 1, 'ib0fodcgsqdl5ihrf02hlttg70');

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
  ADD PRIMARY KEY (`idEmployee`);

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
  MODIFY `idAppointment` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `idEmployee` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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