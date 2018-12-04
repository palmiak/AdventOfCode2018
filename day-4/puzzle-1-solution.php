<?php

$input = file_get_contents('./input.txt');

$lines = explode(PHP_EOL, $input);

sort($lines);

$guards = [];

$guardOnshift = null;
$guardMinuteBeganSleeping = null;

foreach($lines as $line) {

    $attributes = explode(' ', $line);

    // Guard begins their shift
    if(strpos($line, 'begins') !== false) {

        $guardId = ltrim($attributes[3], '#');

        if(!isset($guards[$guardId])) {
            $guards[$guardId] = [
                'guard_id' => $guardId,
                'time_spent_sleeping' => 0,
                'minutes_slept' => [],
            ];

            for($i = 0; $i < 60; $i++) {
                $guards[$guardId]['minutes_slept'][$i] = 0;
            }
        }

        $guardOnshift = $guardId;
        $guardMinuteBeganSleeping = null;

    }

    // Guard falls asleep
    if(strpos($line, 'falls') !== false) {

        $guardMinuteBeganSleeping = substr($attributes[1], 3, 2);

    }

    // Guard wakes up
    if(strpos($line, 'wakes') !== false) {

        $minuteAwoken = substr($attributes[1], 3, 2);

        $minutesAsleep = $minuteAwoken - $guardMinuteBeganSleeping + 1;

        $guards[$guardOnshift]['time_spent_sleeping'] += $minutesAsleep;

        for($minute = $guardMinuteBeganSleeping; $minute < $minuteAwoken; $minute++) {
            $guards[$guardOnshift]['minutes_slept'][(int) $minute] += 1;
        }

    }

}

usort($guards, function($a, $b) {
    return $a['time_spent_sleeping'] > $b['time_spent_sleeping'];
});

$sleepiestGuard = end($guards);
$minuteMostAsleep = array_search(max($sleepiestGuard['minutes_slept']), $sleepiestGuard['minutes_slept']);
$solution = $sleepiestGuard['guard_id'] * $minuteMostAsleep;

echo "Guard {$sleepiestGuard['guard_id']} slept the most during minute {$minuteMostAsleep}, meaning the solution is {$solution}.";
exit();