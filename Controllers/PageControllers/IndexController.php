<?php
	namespace Controllers\PageControllers;

	class IndexController
	{
		private $dataContainer;

		public function __construct()
		{
			$this->dataContainer = new \Models\Utilities\DataContainer();
		}

		public function actionIndex(\DateTime $date)
		{
			$this->dataContainer->setPageParams(
				['page' => 'index',
				'date' => $date]
			);
		}
	}