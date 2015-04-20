<?php

	namespace Models\Interfaces;

	class Http
	{
		private static $instance;

		private $params; // data from HTTP form

		private function __construct() {}

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

		public function convertStartEnd()
		{
			$this->params['start'] = \DateTime::createFromFormat('Y-n-j G:i',
				$this->params['date'] . ' ' . $this->params['start']);

			$this->params['end'] = \DateTime::createFromFormat('Y-n-j G:i',
				$this->params['date'] . ' ' . $this->params['end']);

			return self::$instance;
		}

		public function setParams($params)
		{
			foreach ($params as $key => $val) {
				$this->params[$key] = $val;
			}

			return self::$instance;
		}
	}