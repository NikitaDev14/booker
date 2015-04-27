<?php

	namespace Models\Performers;

	class User extends \BaseRegular
	{
		/**
		 * add new email, name, password, isAdmin (flag)
		 * @return (newId)
		 */
		public function addUser($name, $email, $password, $isAdmin)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL addEmployee(?, ?, ?, ?)')
				->setParam([$email, $name, $password, $isAdmin])
				->execute()->getResult()[0]['newId'];
		}

		/**
		 * @return if $email is set true
		 * false otherwise
		 */
		public function getUserByEml($email)
		{
			return (bool)$this->objFactory->getObjDatabase()
				->setQuery('CALL getEmplByEml(?)')
				->setParam([$email])->execute()->getResult();
		}

		/**
		 * check existing pair $email and $password
		 * @return (idEmployee, IsAdmin)
		 */
		public function getUserByEmlPass($email, $password)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getEmplByEmlPass(?, ?)')
				->setParam([$email, $password])
				->execute()->getResult();
		}

		/**
		 * check session of specified user
		 * @return (idEmployee, Name, Email, IsAdmin)
		 */
		public function getUserByCookie($idUser, $sessionId, $isAdmin)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getEmplByCookie(?, ?, ?)')
				->setParam([$idUser, $sessionId, $isAdmin])
				->execute()->getResult();
		}

		/**
		 * @return (idEmployee, Name, Email, IsAdmin)
		 */
		public function getAllUsers()
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getAllEmpl()')
				->execute()->getResult();
		}

		public function removeUser($idEmpl)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL removeEmployee(?)')
				->setParam([$idEmpl])->execute()
				->getResult()[0]['ROW_COUNT()'];
		}

		public function updateUser($idEmpl, $newName, $newEmail)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL updateEmployee(?, ?, ?)')
				->setParam([$idEmpl, $newName, $newEmail])
				->execute()->getResult()[0]['ROW_COUNT()'];
		}

		/**
		 * set new session for specified user
		 * @return bool (result)
		 */
		public function sessionStart($idUser, $sessionId)
		{
			return (bool) $this->objFactory->getObjDatabase()
				->setQuery('CALL bkr_sessionStart(?, ?)')
				->setParam([$idUser, $sessionId])
				->execute()->getResult();
		}

		/**
		 * stop session of specified user
		 * @return bool (result)
		 */
		public function sessionDestroy($idUser)
		{
			return (bool) $this->objFactory->getObjDatabase()
				->setQuery('CALL bkr_sessionDestroy(?)')
				->setParam([$idUser])->execute()->getResult();
		}
	}