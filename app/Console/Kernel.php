<?php

namespace App\Console;

use App\Http\Controllers\ProductController;
use Aws\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Commands\TestCron::class,
        // Commands\MinuteUpdate::class,
        Commands\DailyQuote::class,
        ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('minute:update')->everyMinute();
        // $schedule->command('quote:daily')->everyMinute();
        // so lan call co the thay doi tuy theo so file, ngoai ra co the set max_file_on_process o class command nua
        $schedule->command('s3:scan-deleted-object')->everyMinute();
        // $schedule->call('App\Http\Controllers\ProductController@index')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
