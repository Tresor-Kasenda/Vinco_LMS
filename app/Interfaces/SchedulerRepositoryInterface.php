<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Services\CalendarService;

interface SchedulerRepositoryInterface
{
    public function render(CalendarService $service): array;
}
