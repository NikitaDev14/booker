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
			if(true === (bool) $this->user)
			{
				$this->nextPage = 'Room';
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $this->user]);
		}

		public function getAppointments()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			if(true === (bool) $this->user)
			{
				$this->nextPage = 'AppointmentList';
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $formData]);
		}
	}