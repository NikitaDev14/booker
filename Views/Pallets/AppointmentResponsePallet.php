<?php

	namespace Views\Pallets;

	class AppointmentResponsePallet
	{
		public function generate($response)
		{
			header(HEADER_FOR_JSON);

			echo json_encode($response);
		}
	}