<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanModel extends Model
{
    use HasFactory;

    function getsumaryoutbox($bulan, $tahun, $today)
    {
        if ($today != null) {
            $data = DB::table('vsummaryoutbox2')
                // ->select('vsummaryoutbox.*')
                ->where('fin_month', $bulan)
                ->where('fin_year', $tahun)
                ->where('tgl_kirim', $tahun . '-' . $bulan . '-' . $today)
                ->get();
        } else {

            $data = DB::table('vsummaryoutbox2')
                // ->select('vsummaryoutbox.*')
                ->where('fin_month', $bulan)
                ->where('fin_year', $tahun)
                ->get();
        }
        dd($data, $bulan, $tahun, $today);
        return $data;
    }
}
