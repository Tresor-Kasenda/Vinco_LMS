<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Institution;
use App\Notifications\InstitutionNotification;
use Illuminate\Support\Facades\Notification;

class InstitutionListener
{
    public function handle($event): void
    {
        $institution = Institution::query()
            ->where('institution_email', '=', $event->institution->email)
            ->first();
        Notification::send($institution, new InstitutionNotification($event->institution));
    }
}
