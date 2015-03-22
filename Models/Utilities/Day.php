<?php

	namespace Models\Utilities;

	class Day
	{
		public static $baseDate;
		public $date;

		public function __construct(\DateTime $date)
		{
			$this->date = $date;
		}
	}