<?php

/*
 * Holy nested loops.
 * ¯\_(ツ)_/¯ 
 */

$input = file_get_contents('./input.txt');

$lines = explode(PHP_EOL, $input);

foreach ($lines as $line)  {

    foreach ($lines as $referenceLine) {

        $distance = levenshtein($line, $referenceLine);

        if ($distance == 1) {

            $lineA = str_split($line);
            $lineB = str_split($referenceLine);

            $commonLine = implode('', array_intersect($lineA, $lineB));

            echo 'Line A: ' . $line . PHP_EOL;
            echo 'Line B: ' . $referenceLine . PHP_EOL;

            echo 'Solution: ' . $commonLine;
            exit();

        }
    }
}