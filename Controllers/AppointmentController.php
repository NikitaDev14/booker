<?php

	namespace Controllers;

	class AppointmentController extends BaseController
	{
		public function addAppointment()
		{
			$cookie = $this->objFactory->getObjCookie();
			$validatorUser = $this->objFactory->getObjValidatorUser();

			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->convertDates()->getParams();

			if($formData['empl'] === $cookie->getCookie('id'))
			{
				$isValidUser = (bool) $validatorUser->isValidUser();
			}
			else
			{
				$isValidUser = (bool) $validatorUser->isValidAdmin();
			}

			$isValidAppn = $this->objFactory->getObjValidatorAppointment()
				->setForm($formData)->isValidAppointment();

			$nextPage = 'Echo';
			$result = false;

			if (true === $isValidUser && true === $isValidAppn)
			{
				$result = $this->objFactory->getObjAppointment()
					->addAppn
					(
						$formData['date']->format('Y-m-d'),
						$formData['start']->format('H:i'),
						$formData['end']->format('H:i'),
						$formData['room'],
						$formData['empl'],
						$formData['descr'],
						$formData['recurr'],
						$formData['dur']
					);

				$nextPage = 'AppointmentResponse';
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $nextPage, 'result' => $result]);
		}
		public function getAppointmentDetails()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$isValidUser = (bool) $this->objFactory
				->getObjValidatorUser()->isValidUser();

			$nextPage = 'Echo';
			$result = false;

			if (true === $isValidUser)
			{
				$nextPage = 'AppointmentDetails';
				$result = $formData['idAppn'];
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $nextPage, 'result' => $result]);
		}
		public function deleteAppointment()
		{
			$cookie = $this->objFactory->getObjCookie();
			$validatorUser = $this->objFactory->getObjValidatorUser();

			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			if($formData['idEmpl'] === $cookie->getCookie('id'))
			{
				$user = $validatorUser->isValidUser();
			}
			else
			{
				$user = $validatorUser->isValidAdmin();
			}

			$result = false;

			if (true == $user)
			{
				$result = $this->objFactory->getObjAppointment()
					->deleteAppointment
					(
						$formData['idAppn'],
						$formData['idEmpl'],
						(int) ($formData['isRecurred'] === 'true')
					);
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => 'Echo', 'result' => $result]);
		}
	}