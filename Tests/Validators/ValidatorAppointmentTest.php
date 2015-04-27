<?php

	namespace Tests\Validators;

	require_once '../requires.php';

	class ValidatorAppointmentTest extends \Tests\SingletonTest
	{
		public function __construct()
		{
			parent::__construct('\Models\Validators\ValidatorAppointment',
				\Models\Validators\ValidatorAppointment::getInstance());
		}

		public function testHasForm()
		{
			$this->assertClassHasAttribute('form', $this->className);
		}

		public function testSetForm()
		{
			$this->assertInstanceOf($this->className,
				$this->instance->setForm([
						'date' => TEST_DATE,
						'start' => TEST_START,
						'end' => TEST_END,
						'isRecurr' => TEST_IS_RECURR,
						'dur' => TEST_DURATION]
				));
		}
	}