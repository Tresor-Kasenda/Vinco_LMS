<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Lesson;

final class CalendarService
{
    public function generateCalendarData($weekDays): array
    {
        $calendarData = [];
        $timeRange = (new TimeService)->generateTimeRange(
            config('app.calendar.start_time'),
            config('app.calendar.end_time')
        );
        $lessons = Lesson::with('class', 'teacher')
            ->calendarByRoleOrClassId()
            ->get();

        foreach ($timeRange as $time) {
            $timeText = $time['start'].' - '.$time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day) {
                $lesson = $lessons->where('weekday', $index)->where('start_time', $time['start'])->first();

                if ($lesson) {
                    $calendarData[$timeText][] = [
                        'class_name' => $lesson->class->name,
                        'teacher_name' => $lesson->teacher->name,
                        'rowspan' => $lesson->difference / 30 ?? '',
                    ];
                } elseif (! $lessons->where('weekday', $index)
                    ->where('start_time', '<', $time['start'])
                    ->where('end_time', '>=', $time['end'])
                    ->count()
                ) {
                    $calendarData[$timeText][] = 1;
                } else {
                    $calendarData[$timeText][] = 0;
                }
            }
        }

        return $calendarData;
    }
}
