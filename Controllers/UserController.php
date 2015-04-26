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
			$result = false;

			if(true === (bool) $this->user)
			{
				$this->nextPage = 'User';
				$result = $this->user;
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}

		/**
		 * if user is logged
		 * set response (idEmployee, Name, Email, IsAdmin), false otherwise
		 */
		public function validateAdmin()
		{
			$result = false;

			if(true === (bool) $this->admin)
			{
				$this->nextPage = 'User';
				$result = $this->admin;
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}

		public function getAllUsers()
		{
			if(true === (bool) $this->admin)
			{
				$this->nextPage = 'EmployeeList';
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $this->admin]);
		}

		public function removeUser()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$result = false;

			if(true === (bool) $this->admin)
			{
				$result = $this->objFactory->getObjUser()
					->removeUser($formData['idEmpl']);
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}

		public function updateUser()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$result = false;

			if(true === (bool) $this->admin)
			{
				$result = $this->objFactory->getObjUser()
					->updateUser
					(
						$formData['idEmpl'],
						$formData['name'],
						$formData['email']
					);
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
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

			if (true === (bool) $user)
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
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}

		/**
		 * delete cookie and session
		 * set response true, false otherwise
		 */
		public function logout()
		{
			$result = false;

			if(true === (bool) $this->user)
			{
				$result = $this->objFactory->getObjUser()
					->sessionDestroy($this->user[0]['idEmployee']);

				$this->objFactory->getObjCookie()
					->deleteCookie('id')
					->deleteCookie('isAdmin')
					->deleteCookie('session');
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}

		public function signup()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$form = $this->objFactory->getObjValidatorSignup()
				->setForm($formData)->isValidForm();

			$result = false;

			if(true === (bool) $this->admin && true === $form)
			{
				$result = $this->objFactory->getObjUser()
					->addUser
					(
						$formData['name'],
						$formData['email'],
						$formData['password'],
						(bool) $formData['isAdmin']
					);
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}
	}