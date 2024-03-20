<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceOutstanding extends Model
{
    use HasFactory;

    protected $table = 'invoice_reminder';

    protected $fillable = [
        'fin_month',
        'fin_year',
        'reminder_no',
        'debtor_acct',
        'name',
        'tag_ipl',
        'tag_dc',
        'tag_air',
        'tung_ipl',
        'tung_dc',
        'tung_air',
        'tung_denda',
        'tung_asuransi',
        'filename',
    ];
}
