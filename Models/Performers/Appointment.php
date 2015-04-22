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

		public function getAppointmentDetails($idAppointment)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getAppnDetails(?)')
				->setParam([$idAppointment])
				->execute()->getResult();
		}

		public function deleteAppointment($idAppn, $idEmpl, $isRecurred)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL deleteAppointment(?, ?, ?)')
				->setParam([$idAppn, $idEmpl, $isRecurred])
				->execute()->getResult()[0]['ROW_COUNT()'];
		}
	}