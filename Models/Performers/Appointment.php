<?php

	namespace Models\Performers;

	class Appointment extends \BaseRegular
	{
		/**
		 * @return (idAppointment, Date, Start, End)
		 */
		public function getAppns($year, $month, $idRoom)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getAppnsByMonthRoom(?, ?, ?)')
				->setParam([$year, $month, $idRoom])
				->execute()->getResult();
		}

		/**
		 * @return (result)
		 * when was overlapping 'result' = 0,
		 * otherwise 'result' = 1
		 */
		public function addAppn($date, $start, $end, $room,
		                        $empl, $descr, $recurr, $dur)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL addAppointment(?, ?, ?, ?, ?, ?, ?, ?)')
				->setParam([$date, $start, $end, $room,
					$empl, $descr, $recurr, $dur])
				->execute()->getResult()[0]['result'];
		}

		/**
		 * @return (Date, Start, End, idAppointment, idEmployee,
		 * EmployeeName, idRecurring, Description, Submitted)
		 */
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

		public function updateAppointment($idAppn, $newStart, $newEnd,
		                                  $newDescr, $idEmpl, $isRecurred)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL updateAppointment(?, ?, ?, ?, ?, ?)')
				->setParam([$idAppn, $newStart, $newEnd,
					$newDescr, $idEmpl, $isRecurred])
				->execute()->getResult()[0]['ROW_COUNT()'];
		}
	}