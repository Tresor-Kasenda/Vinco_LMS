<?php

namespace App\Providers;

use App\Contracts\LessonTypeInterface;
use App\Repositories\OpenClose\AperyLessonType;
use App\Repositories\OpenClose\PdfLessonType;
use App\Repositories\OpenClose\VideoLessonType;
use App\View\Components\Statistic;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LessonTypeInterface::class, VideoLessonType::class);
        $this->app->bind(LessonTypeInterface::class, PdfLessonType::class);
        $this->app->bind(LessonTypeInterface::class, AperyLessonType::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('statistic', Statistic::class);

        Blade::directive('format', function ($number) {
            return "<?php echo number_format($number, 2); ?>";
        });

        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) : ?>";
        });

        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });

        Blade::directive('permission', function ($permission) {
            return "<?php if(auth()->check() && auth()->user()->givePermission({$permission})) : ?>";
        });

        Blade::directive('endpermission', function ($role) {
            return "<?php endif; ?>";
        });
    }
}
