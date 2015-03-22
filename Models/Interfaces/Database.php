<?php
	namespace Models\Interfaces;

	class Database
	{
		private function connectionDB()
		{
			return new \PDO(hostDB, nameDB, userDB, passDB);
		}
	}