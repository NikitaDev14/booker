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
		public function getPageParam($arg = null)
		{
			return ($arg !== null)? self::$pageParams[$arg] : self::$pageParams;
		}
	}