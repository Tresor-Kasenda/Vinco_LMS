<?php

namespace App\Providers;

use App\Events\AdministrationEvent;
use App\Events\Frontend\Student\StoreStudentEvent;
use App\Events\InstitutionEvent;
use App\Listeners\AdministrationListener;
use App\Listeners\Frontend\Student\StoreStudentListener;
use App\Listeners\InstitutionListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        InstitutionEvent::class => [
            InstitutionListener::class,
        ],
        AdministrationEvent::class => [
            AdministrationListener::class,
        ],
        StoreStudentEvent::class => [
            StoreStudentListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
