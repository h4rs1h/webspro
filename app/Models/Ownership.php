<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ownership extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name',
        'salutation',
        'tel_no',
        'hand_phone',
        'fax_no',
        'owner_acct',
        'lot_no',
        'rentable_area',
        'address1',
        'address2',
        'address3',
        'post_cd',
        'mail_addr1',
        'mail_addr2',
        'mail_addr3',
        'mail_post_cd',
        'type_descs',
        'build_up_area',
        'remark',
        'start_date',
        'handphone4',
        'virtual_acct',
        'virtual_acct_real',

    ];


    public function setStartDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/Y', '01/01/1900')->addDays($value - 2)->format('Y-m-d');
        if ($value === null) {
            $this->attributes['start_date'] = null;
        } else {
            $this->attributes['start_date'] = $date;
        }
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($ownership) {
            // Memeriksa apakah business_id sudah ada dalam database
            $existingOwnership = static::where('business_id', $ownership->business_id)->first();

            // Jika business_id sudah ada
            if ($existingOwnership) {
                // Memperbarui data yang sudah ada
                // $existingOwnership->update($ownership->toArray());
                $existingOwnership->delete();
                // Hentikan proses penyimpanan
                //  return false;
            }
        });
    }
}
