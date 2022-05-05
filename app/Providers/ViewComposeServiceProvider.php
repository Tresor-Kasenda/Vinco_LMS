<?php
declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\AcademicYearComposer;
use App\View\Composers\PersonnelComposer;
use App\View\Composers\RoleComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposeServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        View::composer([
            'backend.domain.*'
        ], RoleComposer::class);

        View::composer([
            'backend.domain.*'
        ], AcademicYearComposer::class);

        View::composer([
            'backend.domain.*'
        ], PersonnelComposer::class);
    }
}
