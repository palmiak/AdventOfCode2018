<?php

$input = file_get_contents('./input.txt');

$lines = explode(PHP_EOL, $input);

$grid = [];
$overlappingInches = 0;

foreach ($lines as $claim) {

    $claimParts = explode(' ', $claim);
    $coordinateParts = explode(',', $claimParts[2]);
    $sizeParts = explode('x', $claimParts[3]);

    $claimId = ltrim($claimParts[0], '#');
    $xCoord = $coordinateParts[0];
    $yCoord = rtrim($coordinateParts[1], ':');
    $width = $sizeParts[0];
    $height = $sizeParts[1];


    for ($x = $xCoord; $x < $xCoord + $width; $x++) {

        for ($y = $yCoord; $y < $yCoord + $height; $y++) {

            $position = "{$x},{$y}";

            if (!isset($grid[$position])) {

                $grid[$position][$claimId] = $claim;

            } else {

                if (count($grid[$position]) == 1) {
                    $overlappingInches++;
                }

                $grid[$position][$claimId] = $claim;

            }

        }

    }

}

echo "Overlapping coordinates: {$overlappingInches}";
exit();
