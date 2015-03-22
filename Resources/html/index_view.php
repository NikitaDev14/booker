<?php
	use Models\Utilities\Day;

	echo '<a href=/' . APP_NAME . '/' . Day::$baseDate->modify('-1 month')->format('Y') .
		'y/' . Day::$baseDate->format('n') .
		'm>&lt;</a><span>' . Day::$baseDate->modify('+1 month')->format('F') .
		'</span><a href=/' . APP_NAME . '/' . Day::$baseDate->modify('+1 month')->format('Y') .
		'y/' . Day::$baseDate->format('n') .
		'm>&gt;</a><table border="1"><tr>';

	for($i = 1; $i <= 7; $i++)
	{
		echo '<th>' . (new \DateTime())->
			setTimestamp(strtotime("Sunday + $i Days"))->
			format('l') . '</th>';
	}

	echo '</tr><tr>';

	foreach($content as $day)
	{
		if($day == null)
		{
			echo '<td></td>';
		}
		else
		{
			echo '<td>' . $day->date->format('j') . '</td>';

			if ($day->date->format('N') == 7)
			{
				echo '</tr><tr>';
			}
		}
	}

	echo '</tr></table>';