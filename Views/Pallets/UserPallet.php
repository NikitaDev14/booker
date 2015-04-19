<?php

	namespace Views\Pallets;

	class UserPallet
	{
		/**
		 * send id, name, isAdmin(flag)
		 * @param $user
		 */
		public function generate($user)
		{
			header(HEADER_FOR_JSON);

			echo json_encode
			([
				'idUser' => $user[0]['idEmployee'],
				'name' => $user[0]['Name'],
				'email' => $user[0]['Email'],
				'isAdmin' => $user[0]['IsAdmin']
			]);
		}
	}