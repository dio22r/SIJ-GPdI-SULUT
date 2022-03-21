<?php

namespace App\Console;

use App\Helpers\JemaatPushNotifHelper;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
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
        // $schedule->call(JemaatPushNotifHelper::prepareBirthdayNotif())->dailyAt('12.00');
        // $schedule->call(JemaatPushNotifHelper::sendBirthdayNotif())->everyFiveMinutes();

        $schedule->call(function () {

            //Pengecekan apakah cronjob berhasil atau tidak
            //Mencatat info log
            Log::info('Cronjob berhasil dijalankan');
        })->everyMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
