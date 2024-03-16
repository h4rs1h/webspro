<?php

namespace App\Imports;

use App\Models\InvoiceSP;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InvoiceSPImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function __construct($bulan, $tahun,  $tgl_cetak, $tgl_batas_bayar, $tgl_tempo_awal, $tgl_tempo_akhir, $reminder_no, $filename)
    {
        $this->fin_month = $bulan;
        $this->fin_year = $tahun;
        $this->tgl_cetak = $tgl_cetak;
        $this->tgl_batas_bayar = $tgl_batas_bayar;
        $this->tgl_tempo_awal = $tgl_tempo_awal;
        $this->tgl_tempo_akhir = $tgl_tempo_akhir;
        $this->reminder_no = $reminder_no;
        $this->filename = $filename;
    }
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        // dd($row, $this->fin_month, $this->fin_year);
        // return new InvoiceSP([
        //     'fin_month' => $this->fin_month,
        //     'fin_year' => $this->fin_year,
        //     'tgl_cetak' => $this->tgl_cetak,
        //     'tgl_batas_bayar' => $this->tgl_batas_bayar,
        //     'tgl_tempo_terakhir' => $this->tgl_tempo_akhir,
        //     'reminder_no' => $this->reminder_no,
        //     'debtor_acct' => $row[0],
        //     'name' => $row[1],
        //     'tag_ipl' => $row[7],
        //     'tag_dc' => $row[8],
        //     'tag_air' => $row[9],
        //     'tunggak_ipl' => $row[11],
        //     'tunggak_dc' => $row[12],
        //     'tunggak_air' => $row[13],
        //     'denda' => $row[14],
        //     'tunggak_asuransi' => $row[15],
        // ]);
        return new InvoiceSP([
            'fin_month' => $this->fin_month,
            'fin_year' => $this->fin_year,
            'tgl_cetak' => $this->tgl_cetak,
            'tgl_batas_bayar' => $this->tgl_batas_bayar,
            'tgl_tempo_awal' => $this->tgl_tempo_awal,
            'tgl_tempo_terakhir' => $this->tgl_tempo_akhir,
            'reminder_no' => $this->reminder_no,
            'debtor_acct' => $row[0],
            'name' => $row[2],
            'tag_ipl' => $row[3],
            'tag_dc' => $row[4],
            'tag_air' => $row[5],
            'tunggak_ipl' => $row[7],
            'tunggak_dc' => $row[8],
            'tunggak_air' => $row[9],
            'denda' => $row[10],
            'tunggak_asuransi' => $row[11],
            'filename' => $this->filename,
        ]);
    }
}
