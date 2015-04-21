<?php

	namespace Views\Pallets;

	class AppointmentDetailsPallet extends \BaseRegular
	{
		public function generate($idAppn)
		{
			header(HEADER_FOR_JSON);

			echo json_encode
			([
				'event' => $this->objFactory
					->getObjAppointment()->getAppointmentDetails($idAppn)
			]);
		}
	}