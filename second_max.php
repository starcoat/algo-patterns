#!/usr/bin/php
<?php

// Rollen von Variablen?

const NTH_MAX = 2;

$numbers = array_slice($argv, 1);

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

			if (count($max_numbers) > NTH_MAX) {
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


if (NTH_MAX == 1) {
	$nth_string = '';
} elseif (substr(NTH_MAX, -2) == '01') {
	$nth_string = NTH_MAX . 'st ';
} elseif ((NTH_MAX == 2) OR (substr(NTH_MAX, -2) == '02')) {
	$nth_string = NTH_MAX . 'nd ';
} elseif ((NTH_MAX == 3) OR (substr(NTH_MAX, -2) == '03')) {
	$nth_string = NTH_MAX . 'rd ';
} else {
	$nth_string = NTH_MAX . 'th ';
}

printf("The %slargest number %d appeared %d %s.\n",
	$nth_string,
	$max_numbers[NTH_MAX - 1]['number'],
	$max_numbers[NTH_MAX - 1]['count'],
	($max_numbers[NTH_MAX - 1]['count'] == 1) ? 'time' : 'times'
);