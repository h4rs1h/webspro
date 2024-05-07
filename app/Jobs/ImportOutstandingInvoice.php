<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Imports\InvoiceOutstandingImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportOutstandingInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $bulan;
    protected $tahun;
    protected $reminder_no;
    protected $path;
    protected $pathfile;
    public function __construct($bulan, $tahun, $reminder_no, $path, $pathfile)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->reminder_no = $reminder_no;
        $this->path = $path;
        $this->pathfile = $pathfile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->bulan, $this->tahun, $this->reminder_no, $this->path, $this->pathfile);
        try {
            // Lakukan sesuatu di sini...
            Excel::import(new InvoiceOutstandingImport($this->bulan, $this->tahun, $this->reminder_no, $this->path), $this->pathfile);
        } catch (\Exception $e) {
            Log::error('ImportFile job failed: ' . $e->getMessage());
            throw $e; // Rethrow exception untuk menampilkan informasi kesalahan ke queue
        }
    }
}
