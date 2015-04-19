<?php

	namespace Models\Performers;

	class Appointment extends \BaseRegular
	{
		public function getAppns($year, $month, $idRoom)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getAppnsByMonthRoom(?, ?, ?)')
				->setParam([$year, $month, $idRoom])
				->execute()->getResult();
		}
	}