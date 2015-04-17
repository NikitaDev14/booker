<?php
	namespace Controllers;

	class IndexController extends \Controllers\BaseController
	{
		public function index()
		{
			$this->objFactory->getObjDataContainer()->
			setParams(['nextPage' => 'Index', 'result' => true]);
		}
	}