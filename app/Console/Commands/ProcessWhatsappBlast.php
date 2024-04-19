<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class ProcessWhatsappBlast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process WhatsApp Blast';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $processRunning = $this->checkProcessStatus();
        $jobCount = DB::table('jobs')->count();

        if ($processRunning) {
            // if ($jobCount == 0) {
            //     $this->stopProcess();
            // } else {
            $this->info('WhatsApp masih jalan, Blast process is already running. Exiting...');
            return;
            // }
        }



        if ($jobCount > 0) {
            $this->info('Processing WhatsApp Blast jobs...');
            $this->call('queue:work', ['--queue' => 'whatsappblast']);
        } else {
            $this->info('No WhatsApp Blast jobs in the queue. Stopping process...');
            $this->stopProcess();
        }

        // if (Queue::size('whatsappblast') == 0) {
        //     // Tidak ada pekerjaan dalam antrian, tampilkan pesan
        //     $this->info('Tidak ada pekerjaan dalam antrian.');
        // } else {
        //     // Ada pekerjaan dalam antrian, lanjutkan dengan menjalankan perintah
        //     $this->info('Pekerjaan dalam antrian sedang diproses.');
        //     $this->call('queue:work', ['--queue' => 'whatsappblast']);
        // }
    }
    protected function checkProcessStatus()
    {
        // Tulis logika untuk memeriksa status proses WhatsApp Blast di sini
        // Anda dapat menggunakan perintah shell 'ps' untuk memeriksa proses yang sedang berjalan
        // Misalnya, gunakan perintah 'ps aux | grep "whatsapp:process"' dan periksa hasilnya
        $output = shell_exec('ps aux | grep "whatsapp:process"');
        $processCount = substr_count($output, 'whatsapp:process');

        // Jika jumlah proses lebih dari 1, proses berjalan
        return $processCount > 0;
    }


    protected function stopProcess()
    {
        // Tulis logika untuk menghentikan proses di sini
        // Misalnya, panggil perintah shell untuk menghentikan proses
        exec('pkill -f whatsapp:process');

        // exec('kill all -9 whatsapp:process'); // Ganti process_name dengan nama proses yang ingin Anda hentikan
    }
}
