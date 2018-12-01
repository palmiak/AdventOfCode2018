<?php

// Grap our input
$input = file_get_contents('./input.txt');

// Convert our input into an array.
$lines = explode(PHP_EOL, $input);

// Frequencies start at zero.
$frequency = 0;

// Store our previously seen frequencies in an array.
$seenFrequencies = [0];

// Perform the following code indefinitely until we find a match.
while (1 == 1) {
    foreach ($lines as $line) {

        // Add this line to our frequency.
        $frequency += $line;

        // If we have already seen this line, outut solution and exit.
        if (in_array($frequency, $seenFrequencies)) {
            echo 'Repeated frequency: ' . $frequency;
            exit();
        }

        // We haven't seen this frequency before, add it to the list and carry on.
        array_push($seenFrequencies, $frequency);

    }
}