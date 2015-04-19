<?php

	namespace Models\Performers;

	class Room extends \BaseRegular
	{
		/**
		 * @return (idRoom, Name)
		 */
		public function getRooms()
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getRooms()')->execute()->getResult();
		}
	}