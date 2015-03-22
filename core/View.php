<?php
	namespace core;

	class View
	{
		private $template = 'core/template.php';
		private $dataContainer;

		public function __construct()
		{
			$this->dataContainer = new \Models\Utilities\DataContainer();

			var_dump($this->dataContainer->getPageParams()['page']);

			require_once $this->template;
		}
	}