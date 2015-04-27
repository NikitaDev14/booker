<?php

	namespace Tests\Utilities;

	require_once '../requires.php';

	class ObjFactoryTest extends \Tests\SingletonTest
	{
		public function __construct()
		{
			parent::__construct('\Models\Utilities\ObjFactory',
				\Models\Utilities\ObjFactory::getInstance());
		}

		public function testHasDatabase()
		{
			$this->assertClassHasStaticAttribute('database',
				'\Models\Utilities\ObjFactory');
		}

		public function testGetDatabase()
		{
			$obj1 = \Models\Utilities\ObjFactory::getInstance()
				->getObjDatabase();

			$obj2 = \Models\Utilities\ObjFactory::getInstance()
				->getObjDatabase();

			$this->assertSame($obj1, $obj2, 'Objects are not the same');
		}

		public function testGetDataContainer()
		{
			$obj = $this->instance->getObjDataContainer();

			$this->assertInstanceOf('\Models\Utilities\DataContainer', $obj);
		}

		public function testGetValidatorSignup()
		{
			$this->assertInstanceOf('\Models\Validators\ValidatorSignup',
				$this->instance->getObjValidatorSignup());
		}

		public function testGetValidatorUser()
		{
			$this->assertInstanceOf('\Models\Validators\ValidatorUser',
				$this->instance->getObjValidatorUser());
		}

		public function testGetValidatorLogin()
		{
			$this->assertInstanceOf('\Models\Validators\ValidatorLogin',
				$this->instance->getObjValidatorLogin());
		}

		public function testGetValidatorAppointment()
		{
			$this->assertInstanceOf('\Models\Validators\ValidatorAppointment',
				$this->instance->getObjValidatorAppointment());
		}

		public function testGetHttp()
		{
			$this->assertInstanceOf('\Models\Interfaces\Http',
				$this->instance->getObjHttp());
		}

		public function testGetCookie()
		{
			$obj = $this->instance->getObjCookie();

			$this->assertInstanceOf('\Models\Interfaces\Cookie', $obj);
		}

		public function testGetUser()
		{
			$obj = $this->instance->getObjUser();

			$this->assertInstanceOf('\Models\Performers\User', $obj);
		}

		public function testGetRoom()
		{
			$obj = $this->instance->getObjRoom();

			$this->assertInstanceOf('\Models\Performers\Room', $obj);
		}

		public function testGetAppointment()
		{
			$obj = $this->instance->getObjAppointment();

			$this->assertInstanceOf('\Models\Performers\Appointment', $obj);
		}
	}