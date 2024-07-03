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
        'deposit',
        'filename',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($invoice) {
            // Memeriksa apakah business_id sudah ada dalam database
            $existingInvoice = static::where('fin_month', $invoice->fin_month)
                ->where('fin_year', $invoice->fin_year)
                ->where('debtor_acct', $invoice->debtor_acct)
                ->where('reminder_no', $invoice->reminder_no)

                ->first();

            // Jika business_id sudah ada
            if ($existingInvoice) {
                // Memperbarui data yang sudah ada
                // $existingOwnership->update($ownership->toArray());
                $existingInvoice->delete();
                // Hentikan proses penyimpanan
                //  return false;
            }
        });
    }
}
