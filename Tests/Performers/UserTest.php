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
			self::$testUser = (int) $this->instance->addUser(
				TEST_NEW_NAME, TEST_NEW_EMAIL, TEST_NEW_PASSWORD, TEST_NEW_IS_ADMIN);

			$this->assertTrue(0 < self::$testUser);
		}

		public function testExsistsUser()
		{
			$this->assertTrue($this->instance->getUserByEml(TEST_NEW_EMAIL));
		}

		public function testIsValidLogin()
		{
			$result = (int)$this->instance->getUserByEmlPass(
				TEST_NEW_EMAIL, TEST_NEW_PASSWORD
			)[0]['idEmployee'];

			$this->assertTrue(0 < $result);
		}

		public function testSessionStart()
		{
			$this->assertTrue($this->instance->sessionStart(
					self::$testUser, TEST_ID_SESSION));
		}

		public function testIsValidUser()
		{
			$result = $this->instance->getUserByCookie(
				self::$testUser, TEST_ID_SESSION, TEST_NEW_IS_ADMIN)[0];

			$this->assertTrue(self::$testUser == $result['idEmployee']);
		}

		public function testSessionDestroy()
		{
			$this->assertTrue($this->instance->sessionDestroy(
					self::$testUser));
		}

		public function testDeleteUser()
		{
			$result = (int) $this->instance->removeUser(self::$testUser);

			$this->assertTrue(0 < $result);
		}
	}