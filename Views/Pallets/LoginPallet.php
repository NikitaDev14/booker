<?php

	namespace Views\Pallets;

	class LoginPallet
	{
		/**
		 * send id, name, isAdmin(flag)
		 * @param $user
		 */
		public function generate($user)
		{
			//header(HEADER_FOR_JSON);

			echo json_encode
			([
				'idUser' => $user[0]['idEmployee'],
				'name' => $user[0]['Name'],
				'isAdmin' => $user[0]['IsAdmin']
			]);
		}
	}