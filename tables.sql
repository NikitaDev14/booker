DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
`idAppointment` int(6) unsigned NOT NULL,
  `idRoom` int(6) unsigned NOT NULL,
  `idRecurring` int(6) unsigned NOT NULL,
  `idEmployee` int(6) unsigned NOT NULL,
  `Date` date NOT NULL,
  `Start` time NOT NULL,
  `End` time NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `recurrings`
--

DROP TABLE IF EXISTS `recurrings`;
CREATE TABLE IF NOT EXISTS `recurrings` (
`idRecurring` int(6) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
`idRoom` int(6) unsigned NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
 ADD PRIMARY KEY (`idAppointment`), ADD KEY `idRoom` (`idRoom`), ADD KEY `idRecurring` (`idRecurring`), ADD KEY `idEmployee` (`idEmployee`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`idEmployee`);

--
-- Индексы таблицы `recurrings`
--
ALTER TABLE `recurrings`
 ADD PRIMARY KEY (`idRecurring`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
 ADD PRIMARY KEY (`idRoom`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`idRoom`) REFERENCES `rooms` (`idRoom`) ON UPDATE CASCADE,
ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`idRecurring`) REFERENCES `recurrings` (`idRecurring`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`idEmployee`) REFERENCES `employees` (`idEmployee`) ON DELETE CASCADE ON UPDATE CASCADE;