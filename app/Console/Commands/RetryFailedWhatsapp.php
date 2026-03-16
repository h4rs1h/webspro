<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RetryFailedWhatsapp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:retry-failed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry failed WhatsApp messages from outbox';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = 10;
        $maxAttempt = 3;

        $minDelay = 10;
        $maxDelay = 20;

        $this->info("Scanning failed WhatsApp messages...");

        $data = Outbox::where('status_proses', 'failed')
            ->where('attempt_count', '<', $maxAttempt)
            ->orderBy('id')
            ->limit($limit)
            ->get();

        if ($data->isEmpty()) {
            $this->info("No failed messages to retry.");
            return Command::SUCCESS;
        }

        $totalDelay = 0;
        $retryCount = 0;

        foreach ($data as $index => $item) {

            if ($index > 0) {
                $totalDelay += random_int($minDelay, $maxDelay);
            }

            $scheduledAt = now()->addSeconds($totalDelay);

            SendMessageWA::dispatch(
                $item->id
            )
            ->delay($scheduledAt)
            ->onQueue('whatsappblast');

            $item->update([
                'status_proses' => 'queued',
                'scheduled_at' => $scheduledAt,
                'job' => $scheduledAt
            ]);

            $retryCount++;
        }

        $this->info("Retry dispatched for {$retryCount} failed messages.");

        return Command::SUCCESS;
    
    }
}
