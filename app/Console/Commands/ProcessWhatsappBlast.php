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
        $job = DB::table('jobs')->count();
        if ($job == 0) {
            $this->stopProcess();
            $this->info('Tidak ada pekerjaan dalam antrian.');
        } else {
            $this->info('Pekerjaan dalam antrian sedang diproses.');
            $this->call('queue:work', ['--queue' => 'whatsappblast']);
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
    protected function stopProcess()
    {
        // Tulis logika untuk menghentikan proses di sini
        // Misalnya, panggil perintah shell untuk menghentikan proses
        exec('killall -9 whatsappblast'); // Ganti process_name dengan nama proses yang ingin Anda hentikan
    }
}
