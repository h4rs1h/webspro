<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceSP extends Model
{
    use HasFactory;

    protected $table = 'invoicesps';

    protected $fillable = [
        'fin_month',
        'fin_year',
        'tgl_cetak',
        'tgl_batas_bayar',
        'tgl_tempo_awal',
        'tgl_tempo_terakhir',
        'reminder_no',
        'debtor_acct',
        'name',
        'tag_ipl',
        'tag_dc',
        'tag_air',
        'tunggak_ipl',
        'tunggak_dc',
        'tunggak_air',
        'denda',
        'tunggak_asuransi',
        'filename',
    ];

    public function getDataSP($fin_year, $fin_month, $reminder_no, $tgl_cetak, $tgl_batas_bayar)
    {

        $data = DB::table('vinvoicesps')
            ->select('vinvoicesps.*')
            ->where('vinvoicesps.fin_year', $fin_year)
            ->where('vinvoicesps.fin_month', $fin_month)
            ->where('vinvoicesps.reminder_no', $reminder_no)
            ->where('vinvoicesps.tgl_cetak', $tgl_cetak)
            // ->where('vinvoicesps.tgl_batas_bayar', $tgl_batas_bayar)
            ->get();
        // dd($fin_month, $fin_year, $tgl_cetak, $reminder_no);
        return $data;
    }
    public function getPreviewDataSP($fin_year, $fin_month, $reminder_no, $tgl_cetak, $tgl_batas_bayar, $ass)
    {

        if ($reminder_no == '1') {
            if ($ass != 'asuransi') {
                $data = DB::table('vinvoicesp1')
                    ->select('vinvoicesp1.*')
                    ->where('vinvoicesp1.fin_year', $fin_year)
                    ->where('vinvoicesp1.fin_month', $fin_month)
                    ->where('vinvoicesp1.reminder_no', $reminder_no)
                    ->where('vinvoicesp1.tgl_cetak', $tgl_cetak)
                    // ->where('vinvoicesps.tgl_batas_bayar', $tgl_batas_bayar)
                    ->get();
            } else {
                $data = DB::table('vinvoicesp1versi1')
                    ->select('vinvoicesp1versi1.*')
                    ->where('vinvoicesp1versi1.fin_year', $fin_year)
                    ->where('vinvoicesp1versi1.fin_month', $fin_month)
                    ->where('vinvoicesp1versi1.reminder_no', $reminder_no)
                    ->where('vinvoicesp1versi1.tgl_cetak', $tgl_cetak)
                    // ->where('vinvoicesps.tgl_batas_bayar', $tgl_batas_bayar)
                    ->get();
            }
            // dd($fin_month, $fin_year, $tgl_cetak, $reminder_no, $ass, $data);
        } elseif ($reminder_no == '2') {
            $data = DB::table('vinvoicesp2')
                ->select('vinvoicesp2.*')
                ->where('vinvoicesp2.fin_year', $fin_year)
                ->where('vinvoicesp2.fin_month', $fin_month)
                ->where('vinvoicesp2.reminder_no', $reminder_no)
                ->where('vinvoicesp2.tgl_cetak', $tgl_cetak)
                // ->where('vinvoicesps.tgl_batas_bayar', $tgl_batas_bayar)
                ->get();
            // dd($fin_month, $fin_year, $tgl_cetak, $reminder_no, $ass, $data);
        } elseif ($reminder_no == '3') {
            $data = DB::table('vinvoicesp3')
                ->select('vinvoicesp3.*')
                ->where('vinvoicesp3.fin_year', $fin_year)
                ->where('vinvoicesp3.fin_month', $fin_month)
                ->where('vinvoicesp3.reminder_no', $reminder_no)
                ->where('vinvoicesp3.tgl_cetak', $tgl_cetak)
                // ->where('vinvoicesps.tgl_batas_bayar', $tgl_batas_bayar)
                ->get();
            // dd($fin_month, $fin_year, $tgl_cetak, $reminder_no, $ass, $data);
        }
        // dd($fin_month, $fin_year, $tgl_cetak, $reminder_no, $ass, $data);
        return $data;
    }
    function getreminder($reminder_no)
    {
        $data = DB::table('vinvoicesps')
            ->select('vinvoicesps.*')
            ->where('vinvoicesps.reminder_no', $reminder_no)
            ->get();
        return $data;
    }
}
