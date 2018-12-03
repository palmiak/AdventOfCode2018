<?php

$input = file_get_contents('./input.txt');

$lines = explode(PHP_EOL, $input);

$claims = [];
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

    $claims[$claimId] = [
        'x' => $xCoord,
        'y' => $yCoord,
        'w' => $width,
        'h' => $height,
    ];

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

foreach ($grid as $gridItem) {

    if (count($gridItem) > 1) {

        foreach ($gridItem as $claimId => $claim) {

            unset($claims[$claimId]);

        }

    }

}

echo 'The following claim does not overlap with any other claims.' . PHP_EOL;
print_r($claims);
exit();
