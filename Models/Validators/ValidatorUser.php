<?php

	namespace Models\Validators;

	class ValidatorUser extends \BaseSingleton
	{
		private static $instance;

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
			$cookie = $this->objFactory->getObjCookie();

			$idUser = $cookie->getCookie('id');
			$sessionId = $cookie->getCookie('session');
			$isAdmin = $cookie->getCookie('isAdmin');

			return $this->objFactory->getObjUser()
				->getUserByCookie($idUser, $sessionId, $isAdmin);
		}

		public function isValidAdmin()
		{
			$cookie = $this->objFactory->getObjCookie();

			$idUser = $cookie->getCookie('id');
			$sessionId = $cookie->getCookie('session');
			$isAdmin = $cookie->getCookie('isAdmin');

			if('1' === $isAdmin)
			{
				$result = (bool) $this->objFactory->getObjUser()
					->getUserByCookie($idUser, $sessionId, $isAdmin);
			}
			else
			{
				$result = false;
			}

			return $result;
		}
	}