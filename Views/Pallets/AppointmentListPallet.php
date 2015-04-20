<?php

	namespace Views\Pallets;

	class AppointmentListPallet extends \BaseRegular
	{
		public function generate($form)
		{
			header(HEADER_FOR_JSON);

			echo json_encode
			([
				'events' => $this->objFactory->getObjAppointment()->getAppns($form['year'], $form['month'], $form['room'])
			]);
		}
	}