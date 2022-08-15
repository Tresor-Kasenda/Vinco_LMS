<?php

declare(strict_types=1);

namespace App\Traits;

trait TimeCalculation
{
    public static function calculate($attributes): array
    {
        $dateOld = $attributes->input('date');
        $time = $attributes->input('start_time');
        $currentTime = strtotime(''.$dateOld.' '.$time.'');
        $hoursToAdd = -2;
        $secondsToAdd = $hoursToAdd * (60 * 60);
        $newTime = $currentTime + $secondsToAdd;
        $date = date('Y-m-d H:i:s', $newTime);
        $time1 = $attributes->input('start_time');
        $time2 = $attributes->input('end_time');
        $array1 = explode(':', (string) $time1);
        $array2 = explode(':', (string) $time2);
        $minutes1 = ($array1[0] * 60.0);
        $minutes2 = ($array2[0] * 60.0);
        $difference = $minutes2 - $minutes1;

        return [$date, $difference];
    }
}
