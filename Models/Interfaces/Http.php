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

		/**
		 * @param $name - key in HTTP form
		 * convert UNIX time to DateTime object
		 */
		public function convertDateTime($name)
		{
			$this->params[$name] = \DateTime::createFromFormat('U', $this->params[$name]);

			$this->params[$name]->modify(EVENT_TIME_OFFSET);

			return self::$instance;
		}

		/**
		 * set event date to start and end
		 */
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
