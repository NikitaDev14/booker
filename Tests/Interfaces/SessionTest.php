<?php

	namespace Tests\Interfaces;

	require_once '../requires.php';

	class SessionTest extends \Tests\SingletonTest
	{
		public function __construct()
		{
			parent::__construct('\Models\Interfaces\Session',
				\Models\Interfaces\Session::getInstance());
		}

		public function testGetSessionId()
		{
			$this->assertInternalType('string',
				$this->instance->getSessionId());
		}
	}