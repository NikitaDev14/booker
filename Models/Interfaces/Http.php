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

		public function convertDateTime($name)
		{
			/*
			$date = $this->params['date'];

			$this->params['date'] =
				\DateTime::createFromFormat('Y-n-j', $this->params['date']);

			$this->params['start'] =
				\DateTime::createFromFormat('Y-n-j G:i', $date .
					' ' . $this->params['start']);

			$this->params['end'] =
				\DateTime::createFromFormat('Y-n-j G:i', $date .
					' ' . $this->params['end']);

			*/
			$this->params[$name] = \DateTime::createFromFormat('U', $this->params[$name]);

			$this->params[$name]->modify(LOCAL_TIMEZONE_OFFSET);

			return self::$instance;
		}

		public function setDateOfAppointment()
		{
			$date = $this->params['date'];

			$year = $date->format('Y');
			$month = $date->format('n');
			$day = $date->format('j');

			$this->params['start']->setDate($year, $month, $day);
            $this->params['end']->setDate($year, $month, $day);

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
