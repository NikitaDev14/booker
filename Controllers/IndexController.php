<?php
	namespace Controllers;

	class IndexController extends BaseController
	{
		public function index()
		{
			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => 'Index', 'result' => true]);
		}

		public function getRooms()
		{
			$result = $this->objFactory->getObjValidatorUser()->isValidUser();

			$nextPage = 'Echo';

			if(false !== $result)
			{
				$nextPage = 'Room';
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $nextPage, 'result' => $result]);
		}

		public function getAppointments()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$result = $this->objFactory->getObjValidatorUser()->isValidUser();

			$nextPage = 'Echo';

			if(false !== $result)
			{
				$nextPage = 'AppointmentList';
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $nextPage, 'result' => $formData]);
		}
	}