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
			return $this->isValidEmail() &&
			$this->isValidPassword() &&
			$this->isValidPasswordRepeat();
		}

		/**
		 * @return true if email is correct and it has not yet registered
		 * otherwise false
		 */
		public function isValidEmail()
		{
			$userExsists = $this->objFactory->getObjUser()->
			exsistsUser($this->form['email']);

			return preg_match(EMAIL_TEMPLATE, $this->form['email']) &&
			!$userExsists;
		}

		public function isValidPassword()
		{
			return (bool)preg_match(PASSWORD_TEMPLATE,
				$this->form['password']);
		}

		public function isValidPasswordRepeat()
		{
			return $this->form['password'] === $this->form['passwordRepeat'];
		}
	}