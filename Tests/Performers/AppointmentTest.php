<?php

	namespace Tests\Performers;

	require_once '../requires.php';

	class AppointmentTest extends \Tests\RegularTest
	{
		private static $idAppn;

		public function __construct()
		{
			parent::__construct('\Models\Performers\Appointment',
				new \Models\Performers\Appointment());
		}

		public function testGetAppns()
		{
			$result = $this->instance->getAppns('2015', '4', '1');

			self::$idAppn = $result[0]['idAppointment'];

			$this->assertArrayHasKey('idAppointment', $result[0]);
		}

		public function testGetAppointmentDetails()
		{
			$result = $this->instance->getAppointmentDetails(self::$idAppn)[0];

			$this->assertArrayHasKey('Date', $result);
		}

		public function testDeleteAppointment()
		{
			$result = $this->instance
				->deleteAppointment(self::$idAppn, TEST_ID_USER, 1);

			$this->assertEquals('0', $result);
		}

		public function testUpdateAppointment()
		{
			$result = $this->instance
				->updateAppointment(self::$idAppn, TEST_START, TEST_END,
					'', TEST_ID_USER, TEST_IS_RECURR);

			$this->assertEquals('0', $result);
		}
	}