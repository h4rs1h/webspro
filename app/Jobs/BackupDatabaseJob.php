<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Spatie\Backup\BackupDestination\BackupDestinationFactory;

class BackupDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // public $queue = 'whatsappbackup';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Melakukan proses backup
        $backupJob = BackupJobFactory::createFromArray(config('backup'));
        $backupJob->run();

        // Ambil lokasi file backup terbaru
        $backupDestinations = BackupDestinationFactory::createFromArray(config('backup.destination.disks'))->getBackupDestinations();
        $newestBackup = null;

        foreach ($backupDestinations as $backupDestination) {
            $backupCollection = $backupDestination->backups();
            if ($backupCollection->isEmpty()) {
                continue;
            }

            $newestBackup = $backupCollection->newest();
            break;
        }

        if ($newestBackup) {
            $backupPath = $newestBackup->path();
            $backupUrl = url($backupPath);

            // Kirim email setelah backup berhasil
            $toEmail = 'hrsanto@gmail.com';
            $subject = 'Backup Database Sukses';
            $message = "Proses backup database berhasil. Anda dapat mengunduh file backup pada link berikut: $backupUrl";

            Mail::raw($message, function ($mail) use ($toEmail, $subject) {
                $mail->to($toEmail)
                    ->subject($subject);
            });
        }
    }
}
