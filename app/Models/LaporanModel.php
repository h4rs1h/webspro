<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanModel extends Model
{
    use HasFactory;

    function getsumaryoutbox($bulan, $tahun)
    {

        $data = DB::table('vsummaryoutbox2')
            // ->select('vsummaryoutbox.*')
            ->where('fin_month', $bulan)
            ->where('fin_year', $tahun)
            ->get();


        return $data;
    }

    function getsumarytoday($today)
    {

        $data = DB::table('vsummaryoutbox2')
            // ->select('vsummaryoutbox.*')
            ->where('tgl_cetak', $today)
            // ->where('fin_year', $tahun)
            ->get();


        return $data;
    }
}
