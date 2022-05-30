<?php

declare(strict_types=1);

namespace App\Services;

class TimeService
{
    public function generateTimeRange($from, $to)
    {
        $time = Carbon::parse($from);
        $timeRange = [];
        do {
            array_push($timeRange, [
                'start' => $time->format('H:i'),
                'end' => $time->addMinutes(30)->format('H:i'),
            ]);
        } while ($time->format('H:i') !== $to);

        return $timeRange;
    }
}
