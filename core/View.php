<?php
	namespace core;

	class View
	{
		private $template = 'core/template.php';
		private $model;
		private $dataContainer;

		public function __construct()
		{
			$this->model = new \Models\Performers\Model();
			$this->dataContainer = new \Models\Utilities\DataContainer();

			$content = $this->model->getCalendar($this->dataContainer->getPageParam('date'));

			require_once '/Resources/html/index.html';

			//echo json_encode(['date' => $this->dataContainer->getPageParam('date')]);
		}
	}