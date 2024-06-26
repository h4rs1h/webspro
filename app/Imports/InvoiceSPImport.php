<?php

namespace App\Imports;

use App\Models\InvoiceSP;
use App\Models\AsuransiSP;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InvoiceSPImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function __construct($bulan, $tahun,  $tgl_cetak, $tgl_batas_bayar, $tgl_tempo_awal, $tgl_tempo_akhir, $reminder_no, $tipe_sp, $reminder_no_ass, $filename)
    {
        $this->fin_month = $bulan;
        $this->fin_year = $tahun;
        $this->tgl_cetak = $tgl_cetak;
        $this->tgl_batas_bayar = $tgl_batas_bayar;
        $this->tgl_tempo_awal = $tgl_tempo_awal;
        $this->tgl_tempo_akhir = $tgl_tempo_akhir;
        $this->reminder_no = $reminder_no;
        $this->reminder_no_ass = $reminder_no_ass;
        $this->filename = $filename;
        $this->tipe_sp = $tipe_sp;
    }
    public function startRow(): int
    {
        return 4;
    }
    public function model(array $row)
    {

        if ($this->reminder_no == 'asuransi') {
            return new AsuransiSP([
                'fin_month' => $this->fin_month,
                'fin_year' => $this->fin_year,
                'tgl_cetak' => $this->tgl_cetak,
                'tgl_batas_bayar' => $this->tgl_batas_bayar,
                'tgl_tempo_terakhir' => $this->tgl_tempo_akhir,
                'reminder_no' => $this->reminder_no_ass,
                'debtor_acct' => $row[0],
                'name' => $row[2],
                'thn_asuransi' => $row[3],
                'total_tagihan' => $row[4],
                'filename' => $this->filename,
            ]);
        } else {
            return new InvoiceSP([
                'fin_month' => $this->fin_month,
                'fin_year' => $this->fin_year,
                'tgl_cetak' => $this->tgl_cetak,
                'tgl_batas_bayar' => $this->tgl_batas_bayar,
                'tgl_tempo_awal' => $this->tgl_tempo_awal,
                'tgl_tempo_terakhir' => $this->tgl_tempo_akhir,
                'reminder_no' => $this->reminder_no,
                'tipe_sp' => $this->tipe_sp,
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
}
