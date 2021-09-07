#!/usr/bin/php
<?php

$numbers = array_slice($argv, 1);

$max_numbers = array();
$max_numbers[] = array(
	'number' => array_shift($numbers),
	'count'  => 1
);

foreach ($numbers as $n) {

	foreach ($max_numbers as $mn) {

		if ($n > $mn['number']) {
			array_unshift($max_numbers, array(
				'number' => $n,
				'count'  => 1
			));
			if (count($max_numbers) > 2) {
				array_pop($max_numbers);
			}
			break;
		}

	}

}

print_r($max_numbers);