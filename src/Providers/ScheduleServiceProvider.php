<?php

namespace DevHau\Modules\Providers;

use DevHau\Modules\Schedule\Scheduling;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule as ScheduleBase;
use Illuminate\Support\Facades\Blade;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('CronNextRunDate', function ($expression) {
            return "<?php echo CronNextRunDate({$expression}); ?>";
        });
        $this->app->resolving(ScheduleBase::class, function ($schedule) {
            $schedule = app(Scheduling::class, ['schedule' => $schedule]);
            return $schedule->execute();
        });
    }
}
