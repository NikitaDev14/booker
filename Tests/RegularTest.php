<?php

	namespace Tests;

	class RegularTest extends \PHPUnit_Framework_TestCase
	{
		protected $className;
		protected $instance;
		protected $objFactory;

		public function __construct($className, $instance)
		{
			parent::__construct();

			$this->className = $className;
			$this->instance = $instance;
			$this->objFactory = \Models\Utilities\ObjFactory::getInstance();
		}

		public function testHasObjFactory()
		{
			$this->assertClassHasAttribute('objFactory', $this->className);
		}

		public function testConstruct()
		{
			$this->assertInstanceOf($this->className, $this->instance);
		}
	}