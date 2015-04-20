<?php

	namespace Controllers;

	class AppointmentController extends BaseController
	{
		public function addAppointment()
		{
			$cookie = $this->objFactory->getObjCookie();
			$validatorUser = $this->objFactory->getObjValidatorUser();

			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->convertStartEnd()->getParams();

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
	}