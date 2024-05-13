<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoicePesan extends Model
{
    use HasFactory;
    protected $table = 'vinvoice_pesan2';

    public function getDataInvoiceReminder($fin_year, $fin_month, $reminder_no)
    {

        $data = DB::table('vinvoice_reminder')
            ->select('vinvoice_reminder.*')
            ->where('vinvoice_reminder.fin_year', $fin_year)
            ->where('vinvoice_reminder.fin_month', $fin_month)
            ->where('vinvoice_reminder.reminder_no', $reminder_no)
            ->get();

        return $data;
    }
}
