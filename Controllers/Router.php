<?php
	namespace Controllers;

	class Router
	{
		private static $instance;

		private function __construct() {}

		public static function getInstance()
		{
			if (null === self::$instance)
			{
				self::$instance = new Router();
			}

			return self::$instance;
		}

		/**
		 * application start
		 */
		public function start()
		{
			$controllerName = 'Index'; // default controller
			$actionName = 'index'; // default action

			$view = new \Views\View();

			$form = false;

			// from HTTP request define needed controller its action,
			// and set HTTP form

			if (!empty($_GET['controller']))
			{
				$controllerName = $_GET['controller'];
				$actionName = $_GET['action'];

				$form = $_GET;
			} elseif (!empty($_POST['controller']))
			{
				$controllerName = $_POST['controller'];
				$actionName = $_POST['action'];

				$form = $_POST;
			}

			$controllerPath = '\Controllers\\' . $controllerName . 'Controller';

			$controllerObj = new $controllerPath($form);

			$controllerObj->$actionName();

			$view->render();
		}
	}