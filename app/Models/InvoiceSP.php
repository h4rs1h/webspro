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

    public function getDataSP($fin_year, $fin_month, $reminder_no)
    {
        $data = DB::table('vinvoicesps')
            ->select('vinvoicesps.*')
            ->where('vinvoicesps.fin_year', $fin_year)
            ->where('vinvoicesps.fin_month', $fin_month)
            ->where('vinvoicesps.reminder_no', $reminder_no)
            ->get();
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
