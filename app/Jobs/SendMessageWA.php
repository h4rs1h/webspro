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
use Illuminate\Queue\Middleware\RateLimited;

class SendMessageWA implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 3;
    public $backoff = [30,60,120];

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

     public function middleware(): array
    {
        return [
            // new RateLimited('whatsapp-blast'),
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $outbox = Outbox::find($this->idOutbox);
        if (!$outbox) {
           // Jika data tidak ditemukan, hentikan proses
            return;
        }
        // Hindari memproses ulang data yang sudah selesai
        if (in_array($outbox->status_proses, ['sent', 'cancelled'])) {
            return;
        }

        // Update status saat mulai diproses
        // $outbox->update([
        //     'status_proses'   => 'processing',
        //     'attempt_count'   => (int) $outbox->attempt_count + 1,
        //     'last_attempt_at' => now(),
        // ]);

        $upd = ([
                'status_proses'   => 'processing',
                'attempt_count'   => (int) $outbox->attempt_count + 1,
                'last_attempt_at' => now(),
                ]);
        Outbox::where('id', $this->idOutbox)->update($upd);

        try{
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

            $responseBody = trim((string) $response->body());

            if (strtolower($responseBody)  === 'success') {
                $upd = ([
                        'tglSending' => now(),
                        'status' => $responseBody,
                        'status_proses' => 'sent',
                        'error_message' => null,
                        'provider_response' => $responseBody,
                         'job' => now()
                    ]);
                Outbox::where('id', $this->idOutbox)->update($upd);
                return;               
            }else{
                 // Simpan response provider sebelum lempar exception
                // $outbox->update([
                //     'status'            => 'error',
                //     'provider_response' => $responseBody,
                //     'error_message'     => 'API Error: ' . $responseBody,
                // ]);
                $upd = ([
                        'status'            => 'error',
                        'provider_response' => $responseBody,
                        'error_message'     => 'API Error: ' . $responseBody,
                        ]);
                Outbox::where('id', $this->idOutbox)->update($upd);

                throw new \Exception('API Error : '.$response->body());
            }
        }catch (\Throwable $e){
            // Simpan error sementara.
            // Status final failed akan dipastikan di method failed()
            // $outbox->update([
            //     'status'            => 'error',
            //     'provider_response' => $outbox->provider_response ?? null,
            //     'error_message'     => $e->getMessage(),
            // ]);
                $upd = ([
                            'status'            => 'error',
                            'provider_response' => $outbox->provider_response ?? null,
                            'error_message'     => $e->getMessage(),
                        ]);
                Outbox::where('id', $this->idOutbox)->update($upd);
            throw $e;

        }
    }
    public function failed(\Throwable $exception)
    {
        $outbox = Outbox::find($this->idOutbox);

        if (! $outbox) {
            return;
        }

        Outbox::where('id',$this->idOutbox)
        ->update([
            'status_proses' => 'failed',
            'error_message' => $exception->getMessage(),
            'status'        => 'failed',
        ]);
    }
}
