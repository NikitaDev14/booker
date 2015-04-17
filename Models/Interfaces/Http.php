<?php

	namespace Models\Interfaces;

	class Http
	{
		private static $instance;

		private $params; // data from HTTP form

		private function __construct()
		{
		}

		public static function getInstance()
		{
			if (null === self::$instance) {
				self::$instance = new Http();
			}

			return self::$instance;
		}

		public function getParams()
		{
			return $this->params;
		}

		public function setParams($params)
		{
			foreach ($params as $key => $val) {
				$this->params[$key] = $val;
			}

			return self::$instance;
		}
	}