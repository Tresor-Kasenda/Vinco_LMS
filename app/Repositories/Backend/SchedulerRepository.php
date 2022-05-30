<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\SchedulerRepositoryInterface;
use App\Models\Lesson;
use App\Services\CalendarService;

class SchedulerRepository implements SchedulerRepositoryInterface
{
    public function render(CalendarService $service): array
    {
        $weekDays     = Lesson::WEEK_DAYS;
        return $service->generateCalendarData($weekDays);
    }
}
