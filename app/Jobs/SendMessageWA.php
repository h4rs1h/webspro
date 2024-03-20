<?php

namespace App\Jobs;

use App\Models\Outbox;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMessageWA implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $idOutbox;
    protected $nowa;
    protected $isipesan;
    protected $keys;
    protected $url;

    public function __construct($keys, $url, $idOutbox, $nowa, $isipesan)
    {
        $this->keys = $keys;
        $this->url = $url;
        $this->idOutbox = $idOutbox;
        $this->nowa = $nowa;
        $this->isipesan = $isipesan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->withOptions([
            'debug' => false,
            'connect_timeout' => false,
            'timeout' => false,
            'verify' => false,
        ])->post($this->url, [
            'phone_no' => $this->nowa,
            'message' => $this->isipesan,
            'key' => $this->keys,
            'skip_link' => true, // Optional untuk skip snapshot link dalam pesan
            'flag_retry'   => 'on', // Optional untuk retry saat gagal mengirim pesan
            'pendingTime'  => 3 // Optional untuk delay sebelum mengirim pesan
        ]);

        $upd = ([
            'tglsending' => now(),
            'status' => $response->body()
        ]);
        Outbox::where('id', $this->idOutbox)
            ->update($upd);
        return $response;
    }
}
