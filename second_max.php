#!/usr/bin/php
<?php

// Rollen von Variablen?

$numbers = array_slice($argv, 1);

$nth_max = 2;

$max_numbers = array();
$max_numbers[] = array(
	'number' => array_shift($numbers),
	'count'  => 1
);

foreach ($numbers as $n) {

	$i = 0;

	foreach ($max_numbers as &$mn) {

		if ($n > $mn['number']) {

			$max_numbers = array_merge(
				array_slice($max_numbers, 0, $i),
				array(array(
					'number' => $n,
					'count'  => 1
				)),
				array_slice($max_numbers, $i)
			);

			if (count($max_numbers) > $nth_max) {
				array_pop($max_numbers);
			}
			break;

		} elseif ($n == $mn['number']) {
			$mn['count']++;
			break;
		}

		$i++;

	}

}


if ($nth_max == 1) {
	$nth_string = '';
} elseif (substr($nth_max, -2) == '01') {
	$nth_string = $nth_max . 'st ';
} elseif (($nth_max == 2) OR (substr($nth_max, -2) == '02')) {
	$nth_string = $nth_max . 'nd ';
} elseif (($nth_max == 3) OR (substr($nth_max, -2) == '03')) {
	$nth_string = $nth_max . 'rd ';
} else {
	$nth_string = $nth_max . 'th ';
}

printf("The %slargest number %d appeared %d %s.\n",
	$nth_string,
	$max_numbers[$nth_max - 1]['number'],
	$max_numbers[$nth_max - 1]['count'],
	($max_numbers[$nth_max - 1]['count'] == 1) ? 'time' : 'times'
);