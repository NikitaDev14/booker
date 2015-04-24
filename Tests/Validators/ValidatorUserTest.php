<?php

	namespace Tests\Validators;

	require_once '../requires.php';

	class ValidatorUserTest extends \Tests\SingletonTest
	{
		public function __construct()
		{
			parent::__construct('\Models\Validators\ValidatorUser',
				\Models\Validators\ValidatorUser::getInstance());
		}

		public function testIsValidUser()
		{
			$this->assertFalse($this->instance->isValidUser());
		}
	}