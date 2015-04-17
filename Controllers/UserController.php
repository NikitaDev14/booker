<?php

	namespace Controllers;

	class UserController extends \Controllers\BaseController
	{
		/**
		 * if user is logged
		 * set response true, false otherwise
		 */
		public function validate()
		{
			$result = (bool) $this->objFactory->getObjValidatorUser()
				->isValidUser();

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => 'Echo', 'result' => $result]);
		}

		/**
		 * get from HTTP form an email and password
		 * if this pair is valid begin session and set cookie,
		 * set response true, false otherwise
		 */
		public function login()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$user = $this->objFactory->getObjValidatorLogin()
				->setForm($formData)->isValidForm();

			$nextPage = 'Echo';
			$result = false;

			if (!empty($user))
			{
				$userId = $user[0]['idEmployee'];

				$sessionId = $this->objFactory->getObjSession()
					->getSessionId();

				$this->objFactory->getObjUser()
					->sessionStart($userId, $sessionId);

				$this->objFactory->getObjCookie()
					->setCookie('id', $userId)
					->setCookie('session', $sessionId);

				$nextPage = 'Login';
				$result = $user;
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $nextPage, 'result' => $result]);
		}
	}