<?php

	namespace Tests\Interfaces;

	require_once '../requires.php';

	class DatabaseTest extends \PHPUnit_Framework_TestCase
	{
		private static $className;
		private static $instance;

		public function __construct()
		{
			parent::__construct();

			self::$className = '\Models\Interfaces\Database';
			self::$instance = new \Models\Interfaces\Database
			(
				DB_NAME,
				DB_HOST,
				DB_USER,
				DB_PASS
			);
		}

		public function testHasDb()
		{
			$this->assertClassHasAttribute('db', self::$className);
		}

		public function testHasSth()
		{
			$this->assertClassHasAttribute('sth', self::$className);
		}

		public function testConstruct()
		{
			$this->assertInstanceOf(self::$className, self::$instance);
		}

		public function testSetQuery()
		{
			$query = 'SELECT e.Name
					FROM employees AS e
					WHERE e.idEmployee = ?';

			$this->assertInstanceOf(self::$className,
				self::$instance->setQuery($query));
		}

		public function testSetParam()
		{
			$this->assertInstanceOf(self::$className,
				self::$instance->setParam([TEST_ID_USER]));
		}

		public function testExecute()
		{
			$this->assertInstanceOf(self::$className,
				self::$instance->execute());
		}

		public function testGetResultKeys()
		{
			$this->assertArrayHasKey('Name', self::$instance->getResult()[0]);
		}
	}