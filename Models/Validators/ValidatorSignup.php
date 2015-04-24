<?php

	namespace Models\Validators;

	class ValidatorSignup extends \BaseSingleton
	{
		private static $instance;
		private $form; // data from HTTP form

		public static function getInstance()
		{
			if (null === self::$instance) {
				self::$instance = new ValidatorSignup();
			}

			return self::$instance;
		}

		public function setForm($form)
		{
			$this->form = $form;

			return self::$instance;
		}

		public function isValidForm()
		{
			return $this->isValidName() &&
				$this->isValidEmail() &&
				$this->isValidPassword() &&
				$this->isValidPasswordRepeat();
		}

		/**
		 * @return true if email is correct and it has not yet registered
		 * otherwise false
		 */
		public function isValidEmail()
		{
			if(!empty($this->form['email']))
			{
				$userExsists = $this->objFactory->getObjUser()
					->getUserByEml($this->form['email']);

				$result = preg_match(EMAIL_TEMPLATE, $this->form['email']) &&
					!$userExsists;
			}
			else
			{
				$result = false;
			}

			return $result;
		}

		public function isValidName()
		{
			if(!empty($this->form['name']))
			{
				$result = (bool)preg_match(NAME_TEMPLATE, $this->form['name']);
			}
			else
			{
				$result = false;
			}

			return $result;
		}

		public function isValidPassword()
		{
			if(!empty($this->form['password']))
			{
				$result = (bool)preg_match(PASSWORD_TEMPLATE,
					$this->form['password']);
			}
			else
			{
				$result = false;
			}

			return $result;
		}

		public function isValidPasswordRepeat()
		{
			return $this->form['password'] === $this->form['passwordRepeat'];
		}
	}