<?php

	namespace Models\Validators;

	class ValidatorUser extends \BaseSingleton
	{
		private $idUser;
		private $sessionId;
		private $isAdmin;
		private $user;

		private static $instance;

		protected function __construct()
		{
			parent::__construct();

			$cookie = $this->objFactory->getObjCookie();

			$this->idUser = $cookie->getCookie('id');
			$this->sessionId = $cookie->getCookie('session');
			$this->isAdmin = $cookie->getCookie('isAdmin');

			$this->user = $this->objFactory->getObjUser()
				->getUserByCookie
				(
					$this->idUser,
					$this->sessionId,
					$this->isAdmin
				);
		}

		public static function getInstance()
		{
			if (null === self::$instance)
			{
				self::$instance = new ValidatorUser();
			}

			return self::$instance;
		}

		/**
		 * @return (idEmployee, Name) if session is set and cookie is not expired
		 * otherwise false
		 */
		public function isValidUser()
		{
			return $this->user;
		}

		public function isValidAdmin()
		{
			if('1' === $this->isAdmin &&
				'1' ===
					((!empty($this->user[0]['IsAdmin']))?
						$this->user[0]['IsAdmin'] : '0'))
			{
				$result = $this->user;
			}
			else
			{
				$result = false;
			}

			return $result;
		}
	}