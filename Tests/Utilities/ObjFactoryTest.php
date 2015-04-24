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

		public function testGetBook()
		{
			$obj = $this->instance->getObjBook();

			$this->assertInstanceOf('\Models\Performers\Book', $obj);
		}

		public function testGetAuthor()
		{
			$obj = $this->instance->getObjAuthor();

			$this->assertInstanceOf('\Models\Performers\Author', $obj);
		}

		public function testGetGenre()
		{
			$obj = $this->instance->getObjGenre();

			$this->assertInstanceOf('\Models\Performers\Genre', $obj);
		}

		public function testGetUser()
		{
			$obj = $this->instance->getObjUser();

			$this->assertInstanceOf('\Models\Performers\User', $obj);
		}

		public function testGetCart()
		{
			$obj = $this->instance->getObjCart();

			$this->assertInstanceOf('\Models\Performers\Cart', $obj);
		}

		public function testGetOrder()
		{
			$obj = $this->instance->getObjOrder();

			$this->assertInstanceOf('\Models\Performers\Order', $obj);
		}
	}