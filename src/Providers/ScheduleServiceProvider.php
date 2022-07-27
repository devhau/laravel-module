<?php

namespace DevHau\Modules\Providers;

use Cron\CronExpression;
use DevHau\Modules\Schedule\Scheduling;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
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
        Validator::extend('cron', function ($attribute, $value, $parameters, $validator) {
            return CronExpression::isValidExpression($value);
        });
        Blade::directive('CronNextRunDate', function ($expression) {
            return "<?php echo CronNextRunDate({$expression}); ?>";
        });
        $this->app->resolving(ScheduleBase::class, function ($schedule) {
            $schedule = app(Scheduling::class, ['schedule' => $schedule]);
            return $schedule->execute();
        });
    }
}
