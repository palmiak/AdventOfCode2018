<?php

/*
 * This solution is.. a bit verbose. And slow. However since I was playing right
 * at midnight when the puzzle dropped, I was going for the fastest solution, not
 * necessarily the best one.
 */

$input = file_get_contents('./input.txt');

$lines = explode(PHP_EOL, $input);

$twiceCount = 0;
$thriceCount = 0;

foreach ($lines as $line) {

    $twoOccurences = false;
    $threeOccurences = false;

    foreach (count_chars($line, 1) as $character => $occurrences) {
        
        switch($occurrences) {
            case 2:
                $twoOccurences = true;
                break;
            case 3:
                $threeOccurences = true;
                break;
        }
    }

    if ($twoOccurences == true) {
        $twiceCount++;
    }

    if ($threeOccurences == true) {
        $thriceCount++;
    }

}

$checksum = $twiceCount * $thriceCount;

echo "Checksum: {$checksum}";
exit();