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
		 * @return idUser if session is set and cookie is not expired
		 * otherwise delete cookie and session, return false
		 */
		public function isValidUser()
		{
			$cookie = $this->objFactory->getObjCookie();

			$idUser = $cookie->getCookie('id');
			$sessionId = $cookie->getCookie('session');

			return $this->objFactory->getObjUser()
				->getUserByCookie($idUser, $sessionId);
		}
	}