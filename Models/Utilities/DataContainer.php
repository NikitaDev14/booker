<?php
	namespace Models\Utilities;

	class DataContainer
	{
		private static $pageParams;

		public function setPageParams($pageParams)
		{
			self::$pageParams = $pageParams;

			return $this;
		}
		public function getPageParams()
		{
			return self::$pageParams;
		}
	}