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

    public function getDataSP()
    {
        DB::select('select a.*,b.hand_phone,b.virtual_acct_real va
        from invoicesps a left join ownerships b on a.debtor_acct=substring(owner_acct,9,15)');
    }
}
