<?php

	namespace Views\Pallets;

	class EmployeeListPallet extends \BaseRegular
	{
		public function generate()
		{
			header(HEADER_FOR_JSON);

			echo json_encode
			([
				'users' => $this->objFactory->getObjUser()->getAllUsers()
			]);
		}
	}