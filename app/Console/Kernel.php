<?php

namespace App\Console;

use App\Jobs\BackupDatabaseJob;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\ProcessWhatsappBlast;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        ProcessWhatsappBlast::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('queue:restart')->everyFiveMinutes();
        // Menjalankan perintah queue:work setiap menit
        $schedule->command('whatsapp:process')->everyMinute()->withoutOverlapping();
        // $schedule->command('inspire')->hourly();


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
