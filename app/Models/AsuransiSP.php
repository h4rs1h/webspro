<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsuransiSP extends Model
{
    use HasFactory;
    protected $table = 'invoice_asuransi';

    protected $fillable = [
        'fin_month',
        'fin_year',
        'tgl_cetak',
        'tgl_batas_bayar',
        'tgl_tempo_terakhir',
        'reminder_no',
        'debtor_acct',
        'name',
        'thn_asuransi',
        'total_tagihan',
        'filename',
    ];
}
