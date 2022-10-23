<?php

declare(strict_types=1);

namespace App\Listeners\Frontend\Student;

use App\Models\User;
use App\Notifications\Frontend\Student\StoreStudentNotification;
use Illuminate\Support\Facades\Notification;

class StoreStudentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(object $event): void
    {
        $student = User::query()
            ->where('id', '=', $event->user->id)
            ->first();

        Notification::send($student, new StoreStudentNotification($event->user));
    }
}
