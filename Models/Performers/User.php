<?php

	namespace Models\Performers;

	class User extends \BaseRegular
	{
		/**
		 * @param $email
		 * @param $name
		 * @param $password
		 * @param $isAdmin
		 * add new email, name, password, isAdmin (flag)
		 * @return (newId)
		 */
		public function addEmployee($email, $name, $password, $isAdmin)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL addEmployee(?, ?, ?, ?)')
				->setParam([$email, $name, $password, $isAdmin])
				->execute()->getResult();
		}

		/**
		 * @param $email
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
		 * @param $email
		 * @param $password
		 * check existing pair $email and $password
		 * @return (idEmployee, Name, isAdmin)
		 */
		public function getUserByEmlPass($email, $password)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getEmplByEmlPass(?, ?)')
				->setParam([$email, $password])
				->execute()->getResult();
		}

		/**
		 * @param $idUser
		 * @param $sessionId
		 * check session of specified user
		 * @return (idUser, SessionId)
		 */
		public function getUserByCookie($idUser, $sessionId)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getEmplByCookie(?, ?)')
				->setParam([$idUser, $sessionId])
				->execute()->getResult();
		}

		/**
		 * @param $idUser
		 * @param $sessionId
		 * set new session for specified user
		 * @return (ROW_COUNT())
		 */
		public function sessionStart($idUser, $sessionId)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL sessionStart(?, ?)')
				->setParam([$idUser, $sessionId])
				->execute()->getResult();
		}

		/**
		 * @param $idUser
		 * stop session of specified user
		 * @return (ROW_COUNT())
		 */
		public function sessionDestroy($idUser)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL sessionDestroy(?)')
				->setParam([$idUser])->execute()->getResult();
		}
	}