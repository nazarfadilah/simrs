use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

<?php

namespace App\Console;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sync:dokter')->everyMinute(); // atau ->hourly(), ->daily(), sesuai kebutuhan
        $schedule->command('sync:perawat')->everyMinute(); // atau ->hourly(), ->daily(), sesuai kebutuhan
        $schedule->command('sync:poli')->everyMinute(); // atau ->hourly(), ->daily(), sesuai kebutuhan
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
