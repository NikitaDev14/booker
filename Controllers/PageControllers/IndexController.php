<?php
	namespace Controllers\PageControllers;

	class IndexController
	{
		private $model;
		private $view;
		private $dataContainer;

		public function __construct()
		{
			$this->model = new \Models\Performers\Model();
			$this->view = new \core\View();
			$this->dataContainer = new \Models\Utilities\DataContainer();
		}

		public function actionIndex(\DateTime $date)
		{
			$this->dataContainer->setPageParams(
				['page' => 'index',
				'date' => $date]
			);

			//$month = $this->model->getCalendar($date);

			//$this->view->render('index', $month);
		}
	}