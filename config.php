<?php
	/*
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'user10');
	define('DB_USER', 'user10');
	define('DB_PASS', 'tuser10');
	*/
	define('DB_NAME', 'booker');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '1234');

	define('TIMEZONE', 'UTC');
	define('LOCAL_TIMEZONE_OFFSET', '+3 hour');

	define('EMAIL_TEMPLATE', '/[0-9a-z_]+@[0-9a-z_]+\\.[a-z]{1,5}/i');
	define('PASSWORD_TEMPLATE', '/.{4,}/');

	define('COOKIE_EXPIRE', 60 * 15);

	define('HEADER_FOR_HTML', 'Content-Type: text/html; charset=utf-8');
	define('HEADER_FOR_JSON', 'Content-Type: application/json; charset=utf-8');

	define('SATURDAY', '6');
	define('SUNDAY', '7');
