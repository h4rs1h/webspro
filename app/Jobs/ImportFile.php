<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Imports\InvoiceImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $path;
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dd($this->path);
        try {
            // Lakukan sesuatu di sini...
            Excel::import(new InvoiceImport(), $this->path);
            // Excel::import(new InvoiceOutstandingImport($this->bulan, $this->tahun, $this->reminder_no, $this->path), $this->pathfile);
        } catch (\Exception $e) {
            Log::error('ImportFile job failed: ' . $e->getMessage());
            throw $e; // Rethrow exception untuk menampilkan informasi kesalahan ke queue
        }
    }
}
