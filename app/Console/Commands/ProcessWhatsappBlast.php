<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
        if (Queue::size('whatsappblast') == 0) {
            // Tidak ada pekerjaan dalam antrian, tampilkan pesan
            $this->info('Tidak ada pekerjaan dalam antrian.');
        } else {
            // Ada pekerjaan dalam antrian, lanjutkan dengan menjalankan perintah
            $this->info('Pekerjaan dalam antrian sedang diproses.');
            $this->call('queue:work', ['--queue' => 'whatsappblast']);
        }
    }
}
