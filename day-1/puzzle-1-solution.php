<?php

// Grab our input
$input = file_get_contents('./input.txt');

// Frequencies start at zero.
$frequency = 0;

// Loop through our input line by line, adding it to $frequency.
foreach (explode(PHP_EOL, $input) as $line) {
    $frequency += $line;
}

// Output the solution.
echo 'Calculated frequency: ' . $frequency;