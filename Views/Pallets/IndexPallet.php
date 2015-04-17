<?php

	namespace Views\Pallets;
	
	class IndexPallet
	{
		public function generate()
		{
			header(HEADER_FOR_HTML);

			require_once 'Resources/html/index.html';
		}
	}