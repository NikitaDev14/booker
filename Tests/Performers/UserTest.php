<?php

	namespace Tests\Performers;

	require_once '../requires.php';

	class UserTest extends \Tests\RegularTest
	{
		private static $testUser;

		public function __construct()
		{
			parent::__construct('\Models\Performers\User',
				new \Models\Performers\User());
		}

		public function testAddUser()
		{
			self::$testUser = (int)$this->instance->addUser(
				TEST_NEW_EMAIL, TEST_NEW_PASSWORD
			)[0]['LAST_INSERT_ID()'];

			$this->assertTrue(0 < self::$testUser);
		}

		public function testExsistsUser()
		{
			$this->assertTrue($this->instance->exsistsUser(TEST_NEW_EMAIL));
		}

		public function testIsValidLogin()
		{
			$result = (int)$this->instance->isValidLogin(
				TEST_NEW_EMAIL, TEST_NEW_PASSWORD
			)[0]['idUser'];

			$this->assertTrue(0 < $result);
		}

		public function testSessionStart()
		{
			$this->assertTrue(0 < $this->instance->sessionStart(
					self::$testUser, TEST_ID_SESSION
				)[0]['ROW_COUNT()']);
		}

		public function testIsValidUser()
		{
			$result = $this->instance->isValidUser(
				self::$testUser, TEST_ID_SESSION
			)[0];

			$this->assertTrue(self::$testUser == $result['idUser'] &&
				TEST_ID_SESSION === $result['SessionId']);
		}

		public function testSessionDestroy()
		{
			$this->assertTrue(0 < $this->instance->sessionDestroy(
					self::$testUser)[0]['ROW_COUNT()']
			);
		}

		public function testDeleteUser()
		{
			$query = 'DELETE FROM users
						WHERE users.idUser = ?';

			$result = $this->objFactory->getObjDatabase()->
			setQuery($query)->setParam([self::$testUser])->
			execute()->getResult();

			$this->assertTrue(0 < $result);
		}
	}