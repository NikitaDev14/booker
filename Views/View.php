<?php

	namespace Views;

	class View extends \BaseRegular
	{
		/**
		 * define needed pallet and call it
		 */
		public function render()
		{
			$params = $this->objFactory->getObjDataContainer()->getParams();

			$palletName = '\Views\Pallets\\' . $params['nextPage'] . 'Pallet';

			$palletObj = new $palletName();

			$palletObj->generate($params['result']);
		}
	}