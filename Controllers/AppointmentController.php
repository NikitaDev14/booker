<?php

	namespace Controllers;

	class AppointmentController extends BaseController
	{
		public function addAppointment()
		{
			$cookie = $this->objFactory->getObjCookie();
			$validatorUser = $this->objFactory->getObjValidatorUser();

			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)
				->convertDateTime('date')
				->convertDateTime('start')
				->convertDateTime('end')
				->setDateOfAppointment()
				->getParams();

			if($formData['empl'] === $cookie->getCookie('id'))
			{
				$isValidUser = (bool) $validatorUser->isValidUser();
			}
			else
			{
				$isValidUser = (bool) $validatorUser->isValidAdmin();
			}

			$isValidAppn = $this->objFactory->getObjValidatorAppointment()
				->setForm($formData)->isValidNewAppointment();

			$result = false;
            //var_dump(new \DateTime());
            //var_dump($formData);

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

				//var_dump($result);
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => 'Echo', 'result' => $result]);
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
						$formData['isRecurred']
					);
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => 'Echo', 'result' => $result]);
		}
		public function updateAppointment()
		{
			$cookie = $this->objFactory->getObjCookie();
			$validatorUser = $this->objFactory->getObjValidatorUser();

			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)
				->convertDateTime('start')
				->convertDateTime('end')
				->getParams();

			if($formData['idEmpl'] === $cookie->getCookie('id'))
			{
				$user = $validatorUser->isValidUser();
			}
			else
			{
				$user = $validatorUser->isValidAdmin();
			}

			$isValidAppn = $this->objFactory->getObjValidatorAppointment()
				->setForm($formData)->isValidUpdAppointment();

			$result = false;

			if (true == $user && true === $isValidAppn)
			{
				$result = $this->objFactory->getObjAppointment()
					->updateAppointment
					(
						$formData['idAppn'],
						$formData['start']->format('H:i'),
						$formData['end']->format('H:i'),
						$formData['descr'],
						$formData['idEmpl'],
						$formData['isRecurr']
					);
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => 'Echo', 'result' => $result]);
		}
	}
