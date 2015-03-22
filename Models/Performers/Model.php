<?php
	namespace Models\Performers;

	class Model
	{
		public function getCalendar(\DateTime $date)
		{
			$date->setDate($date->format('Y'), $date->format('m'), 1);

			\Models\Utilities\Day::$baseDate = (new \DateTime())->setDate(
				$date->format('Y'),
				$date->format('m'),
				$date->format('d'));

			$month = new \ArrayObject();

			for($i = 0; $i < $date->format('N') - 1; $i++)
			{
				$month->append(null);
			}

			for($day = 1; $day <= $date->format('t'); $day++)
			{
				$month->append(new \Models\Utilities\Day(
					(new \DateTime())->setDate(
						$date->format('Y'),
						$date->format('m'),
						$day)));
			}

			$date->setDate($date->format('Y'), $date->format('m'), $date->format('t'));

			for($day = $date->format('N'); $day < 7; $day++)
			{
				$month->append(null);
			}

			//var_dump($month);

			return $month;
		}
	}