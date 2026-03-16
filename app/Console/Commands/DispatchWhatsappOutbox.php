<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Outbox;
use App\Jobs\SendMessageWA;

class DispatchWhatsappOutbox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch WhatsApp messages from outbox';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = 2;
        $minDelay = 5;
        $maxDelay = 10;
        $url = env('WOOWA_URL_SEND') . 'send_message';
        $keys = env('WOOWA_KEY');

        $data = Outbox::where('status_proses','pending')
            ->orderBy('id')
            ->limit($limit)
            ->get();

        if($data->isEmpty()){
            $this->info('No pending WhatsApp messages.');
            return;
        }

        $totalDelay = 0;

        foreach($data as $index => $item){

            if($index > 0){
                $totalDelay += random_int($minDelay,$maxDelay);
            }

            $scheduledAt = now()->addSeconds($totalDelay);

            SendMessageWA::dispatch($keys,$url,$item->id,$item->wa,$item->pesan)
                ->delay($scheduledAt)
                ->onQueue('whatsappblast');

            // $item->update([
            //     'status_proses' => 'queued',
            //     'scheduled_at' => $scheduledAt,
            //     'job' => $scheduledAt
            // ]);
            $upd = ([
                'status_proses' => 'queued',
                'scheduled_at' => $scheduledAt,
                'job' => $scheduledAt
            ]);
            Outbox::where('id', $item->id)->update($upd);

        }

        $this->info($data->count().' jobs dispatched.');
    
    }
}
