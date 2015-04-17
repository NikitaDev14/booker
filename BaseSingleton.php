<?php

	class BaseSingleton
	{
		protected $objFactory;

		protected function __construct()
		{
			$this->objFactory = \Models\Utilities\ObjFactory::getInstance();
		}
	}