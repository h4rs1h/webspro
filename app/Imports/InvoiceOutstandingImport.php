<?php

namespace App\Imports;

use App\Models\InvoiceOutstanding;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class InvoiceOutstandingImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    protected $fin_month;
    protected $fin_year;
    protected $reminder_no;
    protected $filename;

    public function __construct($bulan, $tahun, $reminder_no, $filename)
    {
        $this->fin_month = $bulan;
        $this->fin_year = $tahun;
        $this->reminder_no = $reminder_no;
        $this->filename = $filename;
    }
    public function startRow(): int
    {
        return 4;
    }
    public function model(array $row)
    {
        // $deposit = doubleval(0);

        return new InvoiceOutstanding([
            'fin_month' => $this->fin_month,
            'fin_year' => $this->fin_year,
            'reminder_no' => $this->reminder_no,
            'debtor_acct' => $row[0],
            'name' => $row[2],
            'tag_ipl' => $row[3],
            'tag_dc' => $row[4],
            'tag_air' => $row[5],
            'tung_ipl' => $row[7],
            'tung_dc' => $row[8],
            'tung_air' => $row[9],
            'tung_denda' => $row[10],
            'tung_asuransi' => $row[11],
            // 'deposit' => $deposit, // Gunakan nilai deposit yang sudah dikonversi
            'filename' => $this->filename,
        ]);
    }
}
