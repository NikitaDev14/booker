<?php

	namespace Views\Pallets;

	class RoomPallet extends \BaseRegular
	{
		public function generate()
		{
			header(HEADER_FOR_JSON);

			echo json_encode
			([
				'rooms' => $this->objFactory->getObjRoom()->getRooms()
			]);
		}
	}