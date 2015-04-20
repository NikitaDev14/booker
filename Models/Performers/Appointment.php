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

		/**
		 * @return (mess, result)
		 * if there was event overlapping then 'mess' will contain
		 * string with dates when was overlapping 'result' = 0,
		 * otherwise 'mess' = new id of parent event 'result' = 1
		 */
		public function addAppn($date, $start, $end, $room, $empl, $descr, $recurr, $dur)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL addAppointment(?, ?, ?, ?, ?, ?, ?, ?)')
				->setParam([$date, $start, $end, $room, $empl, $descr, $recurr, $dur])
				->execute()->getResult();
		}
	}