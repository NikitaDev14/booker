<?php

	namespace Models\Validators;

	class ValidatorLogin extends \BaseSingleton
	{
		private static $instance;
		private $form; // data from HTTP form

		public static function getInstance()
		{
			if (null === self::$instance)
			{
				self::$instance = new ValidatorLogin();
			}

			return self::$instance;
		}

		public function setForm($form)
		{
			$this->form = $form;

			return self::$instance;
		}

		/**
		 * @return (idEmployee, IsAdmin) if he's valid
		 * otherwise false
		 */
		public function isValidForm()
		{
			if (isset($this->form['email'], $this->form['password']))
			{
				$result = $this->objFactory->getObjUser()
					->getUserByEmlPass
					(
						$this->form['email'],
						$this->form['password']
					);
			}
			else
			{
				$result = false;
			}

			return $result;
		}
	}