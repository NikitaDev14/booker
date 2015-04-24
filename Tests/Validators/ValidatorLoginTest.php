<?php

	namespace Tests\Validators;

	require_once '../requires.php';

	class ValidatorLoginTest extends \Tests\SingletonTest
	{
		public function __construct()
		{
			parent::__construct('\Models\Validators\ValidatorLogin',
				\Models\Validators\ValidatorLogin::getInstance());
		}

		public function testHasForm()
		{
			$this->assertClassHasAttribute('form', $this->className);
		}

		public function testSetForm()
		{
			$this->assertInstanceOf($this->className,
				$this->instance->setForm(
					['email' => TEST_EMAIL, 'password' => TEST_PASSWORD]
				));
		}

		public function testIsValidForm()
		{
			$result = $this->instance->isValidForm();

			$this->assertEquals(TEST_ID_USER, $result[0]['idUser']);
		}
	}