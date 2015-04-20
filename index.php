<?php
	require_once 'config.php';
	require_once 'loader.php';

	//date_default_timezone_set(TIMEZONE);

	Controllers\Router::getInstance()->start();