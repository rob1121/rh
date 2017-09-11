<?php

namespace App\Console;

use App\Console\Commands\OmegaHourlyUpdate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        OmegaHourlyUpdate::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('omega:read')->dailyAt("02:00");
        $schedule->command('omega:read')->dailyAt("04:00");
        $schedule->command('omega:read')->dailyAt("06:00");
        $schedule->command('omega:read')->dailyAt("08:00");
        $schedule->command('omega:read')->dailyAt("10:00");
        $schedule->command('omega:read')->dailyAt("12:00");
        $schedule->command('omega:read')->dailyAt("14:00");
        $schedule->command('omega:read')->dailyAt("16:00");
        $schedule->command('omega:read')->dailyAt("18:00");
        $schedule->command('omega:read')->dailyAt("20:00");
        $schedule->command('omega:read')->dailyAt("22:00");
        $schedule->command('omega:read')->dailyAt("00:00");
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
