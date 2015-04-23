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

		public function isValidNewAppointment()
		{
			$now = (new \DateTime())->modify(LOCAL_TIMEZONE_OFFSET);
			$form = $this->form;
			$duration = (int) $form['dur'];
			$recurring = $form['recurr'];
			$day = $form['date']->format('N');

			if($form['start'] < $form['end'] &&
				$form['start'] > $now &&
				$day != SATURDAY && $day != SUNDAY)
			{
				if(true == $form['isRecurr'] &&
					(('weekly' === $recurring && $duration > 4) ||
					('bi-weekly' === $recurring && $duration > 2) ||
					('monthly' === $recurring && $duration > 1)) &&
					$duration <= 0)
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

		public function isValidUpdAppointment()
		{
			$form = $this->form;

			if($form['start'] < $form['end'])
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