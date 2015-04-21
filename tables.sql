SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";
--
-- Структура таблицы `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `idAppointment` int(6) unsigned NOT NULL,
  `idRoom` int(6) unsigned NOT NULL,
  `idRecurring` int(6) unsigned NOT NULL,
  `idEmployee` int(6) unsigned DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` time NOT NULL,
  `End` time NOT NULL,
  `Description` text NOT NULL,
  `Submitted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `appointments`
--

TRUNCATE TABLE `appointments`;
--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`idAppointment`, `idRoom`, `idRecurring`, `idEmployee`, `Date`, `Start`, `End`, `Description`, `Submitted`) VALUES
(8, 1, 8, NULL, '2015-04-13', '06:00:00', '08:00:00', '', '2015-04-21 09:29:25'),
(9, 1, 9, NULL, '2015-04-13', '09:00:00', '11:00:00', '', '2015-04-21 09:29:25'),
(10, 1, 9, NULL, '2015-04-20', '09:00:00', '11:00:00', '', '2015-04-21 09:29:25'),
(11, 1, 9, NULL, '2015-04-27', '09:00:00', '11:00:00', '', '2015-04-21 09:29:25'),
(13, 1, 13, 4, '2015-04-15', '12:00:00', '15:00:00', '', '2015-04-21 09:29:25'),
(14, 1, 13, 4, '2015-04-22', '12:00:00', '15:00:00', '', '2015-04-21 09:29:25'),
(15, 1, 13, 4, '2015-04-29', '12:00:00', '15:00:00', '', '2015-04-21 09:29:25'),
(16, 1, 13, 4, '2015-05-06', '12:00:00', '15:00:00', '', '2015-04-21 09:29:25'),
(18, 2, 17, 5, '2015-04-23', '11:00:00', '14:00:00', 'qwe', '2015-04-21 09:29:25'),
(19, 2, 17, 5, '2015-04-30', '11:00:00', '14:00:00', 'qwe', '2015-04-21 09:29:25'),
(20, 2, 17, 5, '2015-05-07', '11:00:00', '14:00:00', 'qwe', '2015-04-21 09:29:25'),
(35, 1, 35, 4, '2015-03-04', '05:00:00', '06:00:00', 'fedfwe', '2015-04-21 09:29:25'),
(36, 1, 35, 4, '2015-04-06', '05:00:00', '06:00:00', 'fedfwe', '2015-04-21 09:29:25'),
(37, 1, 37, 5, '2015-04-21', '01:00:00', '03:00:00', 'gvbtrf', '2015-04-21 09:29:25');

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
-- Очистить таблицу перед добавлением данных `employees`
--

TRUNCATE TABLE `employees`;
--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`idEmployee`, `Name`, `Email`, `Password`, `IsAdmin`, `SessionId`) VALUES
(4, 'Asd Zxc', 'max@i.ua', '*A4B6157319038724E3560894F7F932C8886EBFCF', 1, 'ib0fodcgsqdl5ihrf02hlttg70'),
(5, 'qwe', 'qwe@i.ua', '*A4B6157319038724E3560894F7F932C8886EBFCF', 0, NULL),
(6, 'asd', 'asd@i.ua', '*A4B6157319038724E3560894F7F932C8886EBFCF', 1, 'ib0fodcgsqdl5ihrf02hlttg70');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `idRoom` int(6) unsigned NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `rooms`
--

TRUNCATE TABLE `rooms`;
--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`idRoom`, `Name`) VALUES
(1, 'room 1'),
(2, 'room 2');

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
  MODIFY `idAppointment` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `idEmployee` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `idRoom` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`idRoom`) REFERENCES `rooms` (`idRoom`) ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`idEmployee`) REFERENCES `employees` (`idEmployee`) ON DELETE SET NULL ON UPDATE CASCADE;