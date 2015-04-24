<?php

	namespace Tests\Utilities;

	require_once '../requires.php';

	class DataContainerTest extends \Tests\SingletonTest
	{
		private $testParam;

		public function __construct()
		{
			parent::__construct('\Models\Utilities\DataContainer',
				\Models\Utilities\DataContainer::getInstance());

			$this->testParam = ['nextPage' => 'index', 'result' => true];
		}

		public function testHasParams()
		{
			$this->assertClassHasAttribute('params', $this->className);
		}

		public function testGetParams()
		{
			$this->instance->setParams($this->testParam);

			$this->assertArrayHasKey('nextPage',
				$this->instance->getParams());
		}

		public function testSetParams()
		{
			$this->assertInstanceOf($this->className,
				$this->instance->setParams($this->testParam));
		}
	}