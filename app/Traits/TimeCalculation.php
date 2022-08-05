<?php

declare(strict_types=1);

namespace App\Traits;

trait TimeCalculation
{
    public static function calculate($attributes): array
    {
        $date = $attributes->input('date');
        $start_time = $attributes->input('start_time');
        $end_tie = $attributes->input('end_time');
        $currentTime = strtotime(''.$date.' '.$start_time);
        $secondsToAdd = -2 * (60 * 60);
        $newTime = $currentTime + $secondsToAdd;
        $date = date('Y-m-d H:i:s', $newTime);
        $array1 = explode(':', (string) $start_time);
        $array2 = explode(':', (string) $end_tie);
        $difference = ($array1[0] * 60.0 + $array1[1]) - ($array2[0] * 60.0 + $array2[1]);

        return [
            $date,
            $difference,
        ];
    }
}
