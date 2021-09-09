#!/usr/bin/php
<?php

/*
 * Roles of Variables:
 * 
 * - $argv:			Fixed value
 * - $numbers:		Container / Fixed value
 * - $cur_length:	Stepper
 * - $max_length:	Most-wanted holder
 * - $next:			Temporary
 * - $last:			Follower
 * - $n:			Most-recent holder
 * 
 */

$numbers = array_slice($argv, 1);

$cur_length = 0;
$max_length = 0;
$next = 'ANY'; // 'ANY' | 'GOL' (Greater or Lower) | 'GTR' (Greater) | 'LWR' (Lower)
$last = null;

foreach ($numbers as $n) {

	switch ($next) {

		case 'ANY':
			$cur_length++;
			$next = 'GOL';
			break;

		case 'GOL':
			if ($n < $last) {
				$cur_length++;
				$next = 'GTR';
			} elseif ($n > $last) {
				$cur_length++;
				$next = 'LWR';
			} else {
				$cur_length = 1;
				$next = 'GOL';
			}
			break;

		case 'GTR':
			if ($n > $last) {
				$cur_length++;
				$next = 'LWR';
			} else {
				$cur_length = 1;
				$next = 'GOL';
			}
			break;

		case 'LWR':
			if ($n < $last) {
				$cur_length++;
				$next = 'GTR';
			} else {
				$cur_length = 1;
				$next = 'GOL';
			}
			break;

	}

	$last = $n;

	if ($cur_length > $max_length) {
		$max_length = $cur_length;
	}

}

printf("Longest zigzag sub-sequence: %d\n", ($max_length >= 3) ? $max_length : 0);