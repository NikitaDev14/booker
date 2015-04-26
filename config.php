<?php
	/*                                 //for GFL server
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'user10');
	define('DB_USER', 'user10');
	define('DB_PASS', 'tuser10');
    define('CURRENT_TIME_OFFSET', '+10 hour +25 minute');
    define('EVENT_TIME_OFFSET', '-7 hour');
	*/                                 //for home server
	define('DB_NAME', 'booker');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '1234');
	define('CURRENT_TIME_OFFSET', '+3 hour');
	define('EVENT_TIME_OFFSET', CURRENT_TIME_OFFSET);

	define('TIMEZONE', 'UTC');

	define('NAME_TEMPLATE', '/[A-Za-z\- ]{3,}/');
	define('EMAIL_TEMPLATE', '/[0-9a-z_]+@[0-9a-z_]+\\.[a-z]{1,3}/i');
	define('PASSWORD_TEMPLATE', '/.{4,}/');

	define('COOKIE_EXPIRE', 60 * 15);

	define('HEADER_FOR_HTML', 'Content-Type: text/html; charset=utf-8');
	define('HEADER_FOR_JSON', 'Content-Type: application/json; charset=utf-8');
	define('HEADER_FOR_LOGIN', 'Location: https://localhost/booker/#/login');

	define('SATURDAY', '6');
	define('SUNDAY', '7');

	define('BASE_PATH_FOR_TESTS', '../../');
