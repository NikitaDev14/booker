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
			$duration = (int) $form['dur'];
			$recurring = $form['recurr'];
			$day = $form['date']->format('N');

			if($form['start'] < $form['end'] &&
				$form['start'] >  $now &&
				$day != SATURDAY && $day != SUNDAY)
			{
				if(true == $form['isRecurr'] && $duration <= 0 &&
					(('weekly' === $recurring && $duration > 4) ||
					('bi-weekly' === $recurring && $duration > 2) ||
					('monthly' === $recurring && $duration > 1)))
				{
					$result = false;
				}
				else
				{
					$result = true;
				}
			}
			else
			{
				$result = false;
			}

			return $result;
		}
	}