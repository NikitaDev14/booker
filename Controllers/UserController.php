<?php

	namespace Controllers;

	class UserController extends BaseController
	{
		/**
		 * if user is logged
		 * set response (idEmployee, Name, Email, IsAdmin), false otherwise
		 */
		public function validateUser()
		{
			$user = $this->objFactory->getObjValidatorUser()
				->isValidUser();

			$nextPage = 'Echo';
			$result = false;

			if(true == $user)
			{
				$nextPage = 'User';
				$result = $user;
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $nextPage, 'result' => $result]);
		}

		/**
		 * if user is logged
		 * set response (idEmployee, Name, Email, IsAdmin), false otherwise
		 */
		public function validateAdmin()
		{
			$user = $this->objFactory->getObjValidatorUser()
				->isValidAdmin();

			$nextPage = 'Echo';
			$result = false;

			if(true == $user)
			{
				$nextPage = 'User';
				$result = $user;
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $nextPage, 'result' => $result]);
		}

		public function getAllUsers()
		{
			$result = (bool) $this->objFactory->getObjValidatorUser()
				->isValidAdmin();

			$nextPage = 'Echo';

			if(true === $result)
			{
				$nextPage = 'EmployeeList';
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $nextPage, 'result' => $result]);
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

			$result = false;

			if (true == $user)
			{
				$userId = $user[0]['idEmployee'];

				$sessionId = $this->objFactory->getObjSession()
					->getSessionId();

				$this->objFactory->getObjUser()
					->sessionStart($userId, $sessionId);

				$this->objFactory->getObjCookie()
					->setCookie('id', $userId)
					->setCookie('isAdmin', $user[0]['IsAdmin'])
					->setCookie('session', $sessionId);

				$result = $userId;
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => 'Echo', 'result' => $result]);
		}

		/**
		 * delete cookie and session
		 * set response true, false otherwise
		 */
		public function logout()
		{
			$result = $this->objFactory->getObjValidatorUser()->isValidUser();

			if(true == $result)
			{
				$result = $this->objFactory->getObjUser()
					->sessionDestroy($result[0]['idEmployee']);

				$this->objFactory->getObjCookie()
					->deleteCookie('id')
					->deleteCookie('isAdmin')
					->deleteCookie('session');
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => 'Echo', 'result' => $result]);
		}
	}