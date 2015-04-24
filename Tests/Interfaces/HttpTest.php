<?php

	namespace Tests\Interfaces;

	require_once '../requires.php';

	class HttpTest extends \Tests\SingletonTest
	{
		public function __construct()
		{
			parent::__construct('\Models\Interfaces\Http',
				\Models\Interfaces\Http::getInstance());
		}

		public function testHasParams()
		{
			$this->assertClassHasAttribute('params', $this->className);
		}

		public function testSetParams()
		{
			$this->assertInstanceOf($this->className,
				$this->instance->setParams(['id' => TEST_ID_USER]));
		}

		public function testGetParamsKey()
		{
			$this->assertArrayHasKey('id', $this->instance->getParams());
		}

		public function testGetParamsValue()
		{
			$this->assertSame(TEST_ID_USER,
				$this->instance->getParams()['id']);
		}
	}