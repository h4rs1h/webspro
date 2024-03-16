<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'fin_month',
        'fin_year',
        'debtor_acct',
        'name',
        'block_no',
        'lot_no',
        'start_date',
        'zone_cd',
        'level_no',
        'land_rate',
        'rentable_area',
        'doc_no',
        'mbal_amt',
        'mbase_amt',
        'mdoc_amt',
        'mtax_amt',
        'doc_date',
        'due_date',
        'type_descs',
        'ref_no',
        'descs',
        'land_area',
        'usage',
        'usage_high',
        'saldo_sblm',
        'meter_type',
        'sewage_amt',
        'sewage_percent',
        'min_amt',
        'last_read',
        'calculation_method',
        'curr_read',
        'capacity',
        'capacity_rate',
        'gen_amt1',
        'usage_rate1',
        'usage_rate2',
        'usage_range1',
        'OPR_AMT1',
        'TAX_AMT',
        'usage_11',
        'usage_21',
        'TRX_TYPE',
        'build_up_area',
        'currency_cd',
        'trx_date',
        'gen_rate',
        'tel_no',
        'remark',
        'balance_amt',
        'meter_id',
        'TRX_AMT',
        'outstanding_we',
        'interest',
        'virtual_acct',
        'entity_name',
        'address1',
        'address2',
        'address3',
        'post_cd',
        'telephone_no',
        'fax_no',
        'new_descs_ipl',
        'new_descs_sf',
        'outstanding_mf',
        'fbase_amt',
        'ftax_amt',
        'doc_we',
        'doc_mf',
        'rate_sf',
        'descs_gab_1',
        'descs_gab_2',
        'bulan_descs',
        'fdoc_amt',
        'remarks',
        'audit_date',
        'periode1',
        'periode2',
        'tunggakan_dc',
        'tunggakan_ipl',
        'tunggakan_water',
        'tunggakan_terlambat',
        'Denda_air',
        'Denda_IPL',
        'Denda_DC',
        'rate_ipl',
        'rate_sf1',
        'hand_phone',
        'type',
        'period_water_min',
        'period_water_max',
        'deposit_ipl',
        'deposit_DC',
        'freq',
        'deposit',
        'ttl_air',
        'ttl_ipl_dc',
        'Denda_ppjb_asuransi',
        'outstanding_ppjb_asuransi',
        'virtual_acct_real',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($invoice) {
            // Memeriksa apakah business_id sudah ada dalam database
            $existingInvoice = static::where('fin_month', $invoice->fin_month)
                ->where('fin_year', $invoice->fin_year)
                ->where('debtor_acct', $invoice->debtor_acct)
                ->where('doc_no', $invoice->doc_no)
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

    public function setStartDateAttribute($value)
    {
        // dd($cleanedValue, $date, Carbon::createFromFormat('d/m/Y', $cleanedValue)->format('Y-m-d'));
        if ($value === null) {
            $this->attributes['start_date'] = null;
        } else {
            $parts = explode(' ', $value);
            // $dt = explode('/' , $parts[0]);
            $cleanedValue = $parts[0];
            // dd($cleanedValue);
            // $date = Carbon::createFromFormat('d/m/Y', '01/01/1900')->addDays($value - 2)->format('Y-m-d');
            $date = Carbon::createFromFormat('d/m/Y', $cleanedValue)->format('Y-m-d');
            $this->attributes['start_date'] = $date;
        }
    }

    public function setDocDateAttribute($value)
    {
        // $date = Carbon::createFromFormat('d/m/Y', '01/01/1900')->addDays($value - 2)->format('Y-m-d');
        $date = Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d');
        if ($value === null) {
            $this->attributes['doc_date'] = null;
        } else {
            $this->attributes['doc_date'] = $date;
        }
    }

    public function setDueDateAttribute($value)
    {
        // $date = Carbon::createFromFormat('d/m/Y', '01/01/1900')->addDays($value - 2)->format('Y-m-d');
        $date = Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d');
        if ($value === null) {
            $this->attributes['due_date'] = null;
        } else {
            $this->attributes['due_date'] = $date;
        }
    }

    public function setTrxDateAttribute($value)
    {
        // $date = Carbon::createFromFormat('d/m/Y', '01/01/1900')->addDays($value - 2)->format('Y-m-d');
        $date = Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d');
        if ($value === null) {
            $this->attributes['trx_date'] = null;
        } else {
            $this->attributes['trx_date'] = $date;
        }
    }

    public function setAuditDateAttribute($value)
    {
        $parts = explode('.', $value);
        $cleanedValue = $parts[0];

        // $date = Carbon::createFromFormat('d/m/Y', '01/01/1900')->addDays($value - 2)->format('Y-m-d');
        $date = Carbon::createFromFormat('d/m/Y H:i:s', $cleanedValue)->format('Y-m-d');
        // dd($date);
        if ($value === null) {
            $this->attributes['audit_date'] = null;
        } else {
            $this->attributes['audit_date'] = $date;
        }
    }
}
