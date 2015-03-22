<?php

	namespace Controllers;

	class Router
	{
		private function __construct(){}

		private static $request_tpl = array
		(
			'index' => '/^\/((ru|en)\/room=(1|2|3)\/m=([1-9]|1[0-2])\/y=20(1[5-9]|2[0-9]|30)\/(12|24)\/(mon|sun))?$/'
		);

		private static $controller;
		private static $view;

		private static function isValidURL($url)
		{
			return preg_match(self::$request_tpl[$url], $_SERVER['REQUEST_URI']);
		}

		public static function start()
		{
			self::$controller = new PageControllers\IndexController();

			$url = explode('/', $_SERVER['REQUEST_URI']);

			if(!empty($url[2]))
			{
				self::$controller->actionIndex(
					(new \DateTime())->setDate((int)$url[2], (int)$url[3], 1));
			}
			else
			{
				self::$controller->actionIndex(new \DateTime());

				self::$view = new \core\View();
			}
		}
	}