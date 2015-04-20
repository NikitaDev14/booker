<?php

	namespace Models\Validators;

	class ValidatorAppointment extends \BaseSingleton
	{
		private static $instance;
		private $form; // data from HTTP form

		public static function getInstance()
		{
			if (null === self::$instance)
			{
				self::$instance = new ValidatorAppointment();
			}

			return self::$instance;
		}

		public function setForm($form)
		{
			$this->form = $form;

			return self::$instance;
		}

		public function isValidAppointment()
		{
			$now = new \DateTime();
			$form = $this->form;
			$day = $form['date']->format('N');

			if($form['start'] < $form['end'] &&
				$form['start'] >  $now &&
				$day != '6' && $day != '7')
			{
				$result = true;
			}
			else
			{
				$result = false;
			}

			return $result;
		}
	}