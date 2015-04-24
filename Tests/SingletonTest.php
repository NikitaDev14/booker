<?php

	namespace Tests;

	class SingletonTest extends \PHPUnit_Framework_TestCase
	{
		protected $className;
		protected $instance;

		public function __construct($className, $instance)
		{
			parent::__construct();

			$this->className = $className;
			$this->instance = $instance;
		}

		public function testHasIntance()
		{
			$this->assertClassHasStaticAttribute('instance', $this->className);
		}

		public function testContructSingleton()
		{
			$obj1 = $this->instance->getInstance();
			$obj2 = $this->instance->getInstance();

			$this->assertSame($obj1, $obj2);
		}

		public function testConstruct()
		{
			$this->assertInstanceOf($this->className, $this->instance);
		}
	}