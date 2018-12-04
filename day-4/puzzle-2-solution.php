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
                $guards[$guardId]['minutes_slept'][$i] = [
                    'minute' => $i,
                    'times_slept' => 0,
                ];
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
            $guards[$guardOnshift]['minutes_slept'][(int) $minute]['times_slept'] += 1;
        }

    }

}

$leadingGuard = 0;
$leadingMinute = 0;
$leadingCount = 0;

foreach($guards as $guardKey => $guard) {

    usort($guard['minutes_slept'], function($a, $b) {
        return $a['times_slept'] > $b['times_slept'];
    });

    $guardsSleepiestMinute = end($guard['minutes_slept']);

    if($guardsSleepiestMinute['times_slept'] > $leadingCount) {
        $leadingGuard = $guard['guard_id'];
        $leadingMinute = $guardsSleepiestMinute['minute'];
        $leadingCount = $guardsSleepiestMinute['times_slept'];
    }
}

$solution = $leadingGuard * $leadingMinute;

echo "Guard #{$leadingGuard} slept {$leadingCount} times on minute {$leadingMinute}, meaning the solution is {$solution}.";
