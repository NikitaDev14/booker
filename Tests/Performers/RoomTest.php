<?php

	namespace Tests\Performers;

	require_once '../requires.php';

	class RoomTest extends \Tests\RegularTest
	{
		public function __construct()
		{
			parent::__construct('\Models\Performers\Room',
				new \Models\Performers\Room());
		}

		public function testGetRooms()
		{
			$result = $this->instance->getRooms()[0];

			$this->assertArrayHasKey('idRoom', $result);
		}
	}
