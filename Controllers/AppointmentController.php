<?php

	namespace Controllers;

	class AppointmentController extends BaseController
	{
		public function addAppointment()
		{
			$cookie = $this->objFactory->getObjCookie();

			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)
				->convertDateTime('date')
				->convertDateTime('start')
				->convertDateTime('end')
				->setDateOfAppointment()
				->getParams();

			$isValidAppn = $this->objFactory->getObjValidatorAppointment()
				->setForm($formData)->isValidNewAppointment();

			$result = false;
            //var_dump(new \DateTime());
            //var_dump($formData);

			if (true === $isValidAppn &&
				(($formData['empl'] === $cookie->getCookie('id'))?
					true === (bool) $this->user :
					true === (bool) $this->admin)
			)
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
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}
		public function getAppointmentDetails()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$result = false;

			if (true === (bool) $this->user)
			{
				$this->nextPage = 'AppointmentDetails';
				$result = $formData['idAppn'];
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}
		public function deleteAppointment()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$result = false;

			if (true === (bool) $this->user)
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
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}
		public function updateAppointment()
		{
			$cookie = $this->objFactory->getObjCookie();

			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)
				->convertDateTime('start')
				->convertDateTime('end')
				->getParams();

			$isValidAppn = $this->objFactory->getObjValidatorAppointment()
				->setForm($formData)->isValidUpdAppointment();

			$result = false;

			if (true === $isValidAppn &&
				(($formData['empl'] === $cookie->getCookie('id'))?
					true === (bool) $this->user :
					true === (bool) $this->admin)
			)
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
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}
	}