DELIMITER $$
--
-- Процедуры
--
DROP PROCEDURE IF EXISTS `addAppointment`$$
CREATE PROCEDURE `addAppointment`(IN `NewDate` DATE, IN `NewStart` TIME, IN `NewEnd` TIME, IN `idRoom` INT(6) UNSIGNED, IN `idEmployee` INT(6) UNSIGNED, IN `Description` TEXT CHARSET utf8, IN `Recurring` ENUM('','weekly','bi-weekly','monthly') CHARSET utf8, IN `Duration` INT(1) UNSIGNED)
    MODIFIES SQL DATA
    COMMENT '@Date @Start @End @idRoom @idEmpl @Descr @Recurring @Duration'
BEGIN
	
    DECLARE idNewRecurring INT(6) UNSIGNED;
    DECLARE tempDate DATE;
    DECLARE i INT(2) UNSIGNED DEFAULT 0;
    DECLARE colision INT(6) UNSIGNED DEFAULT 0;
    
    SET tempDate = NewDate;
    
    SET AUTOCOMMIT = 0;
    
    START TRANSACTION;
    
    SELECT (getColision(tempDate, NewStart, NewEnd, idRoom) + colision)
    INTO colision;
    
    INSERT INTO appointments (appointments.Date, appointments.Start, appointments.End, appointments.idRoom, appointments.idEmployee, appointments.Description)
    VALUES (tempDate, NewStart, NewEnd, idRoom, idEmployee, Description);
            
    SELECT LAST_INSERT_ID() 
    INTO idNewRecurring;
    
    addApp: LOOP
        
        CASE Recurring
        	
            WHEN '' THEN
            	LEAVE addApp;
            
            WHEN 'weekly' THEN
            	SET tempDate = tempDate + INTERVAL 7 DAY;
            
            WHEN 'bi-weekly' THEN
            	SET tempDate = tempDate + INTERVAL 14 DAY;
            
            WHEN 'monthly' THEN
                SET tempDate = tempDate + INTERVAL 1 MONTH;
                
                IF(WEEKDAY(tempDate) = 5 OR WEEKDAY(tempDate) = 6) THEN
                	SET tempDate = tempDate + INTERVAL (7 - WEEKDAY(tempDate)) DAY;
                END IF;
        
        END CASE;
        
        IF (i >= Duration) THEN
            LEAVE addApp;
        END IF;
        
        SELECT CONCAT_WS(',', getColision(tempDate, NewStart, NewEnd, idRoom), colision)
        INTO colision;
        
        INSERT INTO appointments (appointments.Date, appointments.Start, appointments.End, appointments.idRecurring, appointments.idRoom, appointments.idEmployee, appointments.Description)
        VALUES (tempDate, NewStart, NewEnd, idNewRecurring, idRoom, idEmployee, Description);
        
        UPDATE appointments 
        SET appointments.idRecurring = idNewRecurring
        WHERE appointments.idAppointment = idNewRecurring;
        
        SET i = i + 1;
        
    END LOOP addApp;
    
    IF(colision = 0) THEN
    
    	SELECT 1 AS result;
        
        COMMIT;
        
    ELSE
    	
        SELECT 0 AS result;
        
        ROLLBACK;
        
    END IF;
    
END$$

DROP PROCEDURE IF EXISTS `addEmployee`$$
CREATE PROCEDURE `addEmployee`(IN `Email` VARCHAR(255) CHARSET utf8, IN `Name` VARCHAR(50) CHARSET utf8, IN `Passw` VARCHAR(50) CHARSET utf8, IN `IsAdmin` TINYINT(1) UNSIGNED)
    MODIFIES SQL DATA
    COMMENT '@Email @Name @Password'
BEGIN
	INSERT INTO employees (employees.Email, employees.Name, employees.Password, employees.IsAdmin)
    VALUES (Email, Name, PASSWORD(Passw), IsAdmin);
    
    SELECT LAST_INSERT_ID() AS newId;
END$$

DROP PROCEDURE IF EXISTS `bkr_sessionDestroy`$$
CREATE PROCEDURE `bkr_sessionDestroy`(IN `idEmployee` INT(6) UNSIGNED)
    MODIFIES SQL DATA
    COMMENT '@idEmployee'
BEGIN
	UPDATE employees
    SET employees.SessionId = NULL
    WHERE employees.idEmployee = idEmployee;
    
    SELECT ROW_COUNT() AS result;
END$$

DROP PROCEDURE IF EXISTS `bkr_sessionStart`$$
CREATE PROCEDURE `bkr_sessionStart`(IN `idEmployee` INT(6) UNSIGNED, IN `SessionId` VARCHAR(50) CHARSET utf8)
    MODIFIES SQL DATA
    COMMENT '@idEmployee @SessionId'
BEGIN
	UPDATE employees
    SET employees.SessionId = SessionId
    WHERE employees.idEmployee = idEmployee;
    
    SELECT ROW_COUNT() AS result;
END$$

DROP PROCEDURE IF EXISTS `deleteAppointment`$$
CREATE PROCEDURE `deleteAppointment`(IN `idAppn` INT(6) UNSIGNED, IN `idEmpl` INT(6) UNSIGNED, IN `isRecurred` BOOLEAN)
    MODIFIES SQL DATA
    COMMENT '@idAppn @isRecurring'
BEGIN
	DECLARE tempId INT(6) UNSIGNED DEFAULT 0;
    DECLARE tempDate DATE;
    
	IF(isRecurred = 0) THEN
		DELETE
        FROM appointments
        WHERE (appointments.Date + INTERVAL appointments.Start HOUR_SECOND) > getCurrentTime()
        	AND appointments.idAppointment = idAppn
            AND (appointments.idEmployee = idEmpl 
                 OR EXISTS(SELECT employees.idEmployee
                           FROM employees
                           WHERE employees.idEmployee = idEmpl
                           AND employees.IsAdmin = 1));
    ELSE 
    	SELECT app.idRecurring
        INTO tempId
        FROM appointments AS app
        WHERE app.idAppointment = idAppn;
        
        SELECT app.Date
        INTO tempDate
        FROM appointments AS app
        WHERE app.idAppointment = idAppn;
        
        DELETE 
        FROM appointments
        WHERE (appointments.Date + INTERVAL appointments.Start HOUR_SECOND) > getCurrentTime()
        	AND appointments.idRecurring = tempId
            AND appointments.Date >= tempDate
            AND (appointments.idEmployee = idEmpl 
                 OR EXISTS(SELECT employees.idEmployee
                           FROM employees
                           WHERE employees.idEmployee = idEmpl
                           AND employees.IsAdmin = 1));
            
    END IF;
    
    SELECT ROW_COUNT();
END$$

DROP PROCEDURE IF EXISTS `getAllEmpl`$$
CREATE PROCEDURE `getAllEmpl`()
    READS SQL DATA
BEGIN
	SELECT empl.idEmployee, empl.Name, empl.Email, empl.IsAdmin
    FROM employees AS empl;
END$$

DROP PROCEDURE IF EXISTS `getAppnDetails`$$
CREATE PROCEDURE `getAppnDetails`(IN `idAppn` INT(6) UNSIGNED)
    READS SQL DATA
    COMMENT '@idAppn'
BEGIN
	SELECT UNIX_TIMESTAMP(app.Date) AS Date, UNIX_TIMESTAMP(CONCAT(app.Date, ' ', app.Start)) AS Start, UNIX_TIMESTAMP(CONCAT(app.Date, ' ', app.End)) AS End, app.idAppointment, app.idEmployee, IF(app.idEmployee IS NULL, 'user deleted', empl.Name) AS EmployeeName, app.idRecurring, app.Description, app.Submitted
    FROM appointments AS app, employees AS empl
    WHERE app.idAppointment = idAppn AND (app.idEmployee = empl.idEmployee OR app.idEmployee IS NULL)
    LIMIT 1;
END$$

DROP PROCEDURE IF EXISTS `getAppnsByMonthRoom`$$
CREATE PROCEDURE `getAppnsByMonthRoom`(IN `Year` VARCHAR(4) CHARSET utf8, IN `Month` VARCHAR(2) CHARSET utf8, IN `idRoom` INT(6) UNSIGNED)
    READS SQL DATA
    COMMENT '@Year @Month @idRoom'
BEGIN
	SELECT app.idAppointment, app.Date, UNIX_TIMESTAMP(CONCAT(app.Date, ' ', app.Start)) AS Start, UNIX_TIMESTAMP(CONCAT(app.Date, ' ', app.End)) AS End
    FROM appointments AS app
    WHERE YEAR(app.Date) = Year AND
    	MONTH(app.Date) = Month AND
        app.idRoom = idRoom;
END$$

DROP PROCEDURE IF EXISTS `getEmplByCookie`$$
CREATE PROCEDURE `getEmplByCookie`(IN `idUser` INT(6) UNSIGNED, IN `SessionId` VARCHAR(50) CHARSET utf8, IN `isAdmin` BOOLEAN)
    READS SQL DATA
    COMMENT '@idUser @SessionId @isAdmin'
BEGIN
	SELECT empl.idEmployee, empl.Name, empl.Email, empl.IsAdmin
    FROM employees AS empl
    WHERE empl.idEmployee = idUser AND
    	empl.SessionId = SessionId AND
        empl.IsAdmin = isAdmin;
END$$

DROP PROCEDURE IF EXISTS `getEmplByEml`$$
CREATE PROCEDURE `getEmplByEml`(IN `Email` VARCHAR(255) CHARSET utf8)
    READS SQL DATA
    COMMENT '@Email'
BEGIN
	SELECT empl.idEmployee
    FROM employees AS empl
    WHERE empl.Email = Email;
END$$

DROP PROCEDURE IF EXISTS `getEmplByEmlPass`$$
CREATE PROCEDURE `getEmplByEmlPass`(IN `Email` VARCHAR(255) CHARSET utf8, IN `Passw` VARCHAR(50) CHARSET utf8)
    READS SQL DATA
    COMMENT '@Email @Password'
BEGIN
	SELECT empl.idEmployee, empl.IsAdmin
    FROM employees AS empl
    WHERE empl.Email = Email AND
    	empl.Password = PASSWORD(Passw);
END$$

DROP PROCEDURE IF EXISTS `getRooms`$$
CREATE PROCEDURE `getRooms`()
    READS SQL DATA
BEGIN
	SELECT rm.idRoom, rm.Name
    FROM rooms AS rm;
END$$

DROP PROCEDURE IF EXISTS `isRecurringAppn`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `isRecurringAppn`(IN `idAppn` INT(6) UNSIGNED)
    READS SQL DATA
    COMMENT '@idAppn'
BEGIN
	SELECT COUNT(app.idAppointment) AS isRecurring
    FROM appointments AS app
    WHERE app.idRecurring = (SELECT app.idRecurring 
                             FROM appointments AS app
                             WHERE app.idAppointment = idAppn);
END$$

DROP PROCEDURE IF EXISTS `removeEmployee`$$
CREATE PROCEDURE `removeEmployee`(IN `idEmpl` INT(6) UNSIGNED)
    MODIFIES SQL DATA
    COMMENT '@idEmpl'
BEGIN
    DELETE 
    FROM appointments
    WHERE (appointments.Date + INTERVAL appointments.Start HOUR_SECOND) > getCurrentTime()
        AND appointments.idEmployee = idEmpl;
                          
    DELETE 
    FROM employees
    WHERE employees.idEmployee = idEmpl;
    
    SELECT ROW_COUNT();
END$$

DROP PROCEDURE IF EXISTS `updateAppointment`$$
CREATE PROCEDURE `updateAppointment`(IN `idAppn` INT(6) UNSIGNED, IN `newStart` TIME, IN `newEnd` TIME, IN `newDescr` TEXT CHARSET utf8, IN `idEmpl` INT(6) UNSIGNED, IN `isRecurred` BOOLEAN)
    MODIFIES SQL DATA
    COMMENT '@idAppn @newStart @newEnd @newDescr'
BEGIN
	DECLARE colision INT(6) UNSIGNED DEFAULT 0;
    DECLARE idRecurr INT(6) UNSIGNED;
    DECLARE selectedDate DATE;
    
    If(isRecurred = 0) THEN
    
	  	SELECT COUNT(app.Date)
        INTO colision
      	FROM appointments AS app
        WHERE (
            (newStart <= app.Start AND app.Start < newEnd) OR
            (newStart < app.End AND app.End <= newEnd) OR
            (app.Start <= newStart AND newEnd <= app.End) OR
            (newStart <= app.Start AND app.End <= newEnd)
        ) 
            AND app.idAppointment <> idAppn
            AND app.Date = (SELECT appointments.Date 
                            FROM appointments
                            WHERE appointments.idAppointment = idAppn);
    
    	UPDATE appointments
        SET appointments.Start = newStart, appointments.End = newEnd, appointments.Description = newDescr, appointments.idEmployee = idEmpl
        WHERE (appointments.Date + INTERVAL appointments.Start HOUR_SECOND) > getCurrentTime()
        	AND appointments.idAppointment = idAppn
            AND (appointments.idEmployee = idEmpl
                 OR EXISTS(SELECT employees.idEmployee
                           FROM employees
                           WHERE employees.idEmployee = idEmpl
                           AND employees.IsAdmin = 1))
           	AND colision = 0;
            
    ELSE
        
        SELECT app.idRecurring 
        INTO idRecurr
        FROM appointments AS app
        WHERE app.idAppointment = idAppn;
        
        SELECT app.Date
        INTO selectedDate
        FROM appointments AS app
        WHERE app.idAppointment = idAppn;
    
    	SELECT COUNT(app.Date)
        INTO colision
        FROM appointments AS app
        WHERE (
        	(newStart <= app.Start AND app.Start < newEnd) OR
            (newStart < app.End AND app.End <= newEnd) OR
            (app.Start <= newStart AND newEnd <= app.End) OR
            (newStart <= app.Start AND app.End <= newEnd)
       	) 
        AND app.Date IN (SELECT app.Date 
                         FROM appointments AS app
                         WHERE app.idRecurring = idRecurr)
        AND app.idRecurring <> idRecurr;
        
        UPDATE appointments
        SET appointments.Start = newStart, appointments.End = newEnd, appointments.Description = newDescr, appointments.idEmployee = idEmpl
        WHERE (appointments.Date + INTERVAL appointments.Start HOUR_SECOND) > getCurrentTime()
        	AND appointments.Date >= selectedDate
        	AND appointments.idRecurring = idRecurr
            AND (appointments.idEmployee = idEmpl
                 OR EXISTS(SELECT employees.idEmployee
                           FROM employees
                           WHERE employees.idEmployee = idEmpl
                           AND employees.IsAdmin = 1))
           	AND colision = 0;
    
    END IF;
    
    SELECT ROW_COUNT();
END$$

DROP PROCEDURE IF EXISTS `updateEmployee`$$
CREATE PROCEDURE `updateEmployee`(IN `idEmpl` INT(6) UNSIGNED, IN `NewName` VARCHAR(50) CHARSET utf8, IN `NewEmail` VARCHAR(255) CHARSET utf8)
    MODIFIES SQL DATA
    COMMENT '@idEmpl @NewName @NewEmail'
BEGIN
	UPDATE employees
    SET employees.Name = NewName, employees.Email = NewEmail
    WHERE employees.idEmployee = idEmpl;
    
    SELECT ROW_COUNT();
END$$

--
-- Функции
--
DROP FUNCTION IF EXISTS `getColision`$$
CREATE FUNCTION `getColision`(`NewDate` DATE, `NewStart` TIME, `NewEnd` TIME, `idRoom` INT(6) UNSIGNED) RETURNS int(6) unsigned
    READS SQL DATA
    COMMENT '@Date @Start @End @idRoom'
BEGIN
	RETURN (
        SELECT COUNT(app.Date)
        FROM appointments AS app
        WHERE (
            (NewStart <= app.Start AND app.Start < NewEnd) OR
            (NewStart < app.End AND app.End <= NewEnd) OR
            (app.Start <= NewStart AND NewEnd <= app.End) OR
            (NewStart <= app.Start AND app.End <= NewEnd)
            ) AND
            app.Date = NewDate AND
            app.idRoom = idRoom);
END$$

DROP FUNCTION IF EXISTS `getCurrentTime`$$
CREATE FUNCTION `getCurrentTime`() RETURNS timestamp
    NO SQL
    COMMENT 'returns current timestamp with set offset'
BEGIN
-- 	RETURN UTC_TIMESTAMP() + INTERVAL '10:25' HOUR_MINUTE; -- for GFL server
	RETURN UTC_TIMESTAMP() + INTERVAL '3' HOUR;            -- for home server
END$$

DELIMITER ;

-- --------------------------------------------------------