<?php

namespace App\Http\Controllers;

use App\Models\lantai;
use App\Models\RereModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RereController extends Controller
{
    function index()
    {
        $lantai = lantai::all();
        $tower = DB::select('select distinct tower as id,tower as name from vpecahunit  order by tower');

        $bulan = [
            ['id' => 1, 'name' => 'Januari'],
            ['id' => 2, 'name' => 'Februari'],
            ['id' => 3, 'name' => 'Maret'],
            ['id' => 4, 'name' => 'April'],
            ['id' => 5, 'name' => 'Mei'],
            ['id' => 6, 'name' => 'Juni'],
            ['id' => 7, 'name' => 'Juli'],
            ['id' => 8, 'name' => 'Agustus'],
            ['id' => 9, 'name' => 'September'],
            ['id' => 10, 'name'  => 'Oktober'],
            ['id' => 11, 'name'  => 'November'],
            ['id' => 12, 'name'  => 'Desember']
        ];
        $tahun = [
            ['id' => '2024', 'name' => '2024'],
            ['id' => '2025', 'name' => '2025'],
            ['id' => '2026', 'name' => '2026'],
            ['id' => '2027', 'name' => '2027'],
            ['id' => '2028', 'name' => '2028'],
        ];

        return view('Rere.index', [
            'username' => Auth::user()->name,
            'title' => 'Tenant Relation',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tower' => $tower,
            'lantai' => $lantai,
            'javascript' => 'Rere.script'
        ]);
    }
    function getpreview(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'title' => 'required',
            'tgl_pesan' => 'required|date_format:Y-m-d|date',
            'jam_pesan' => 'required',
            'isi_pesan' => 'required',
            'tower' => 'required',
            'tower2' => 'required',
            'lantai' => 'required',
            'lantai2' => 'required',
        ], [
            'title.required' => 'Wajib isi Title Info',
            'tgl_pesan.required' => 'Wajib isi Tanggal Pesan',
            'jam_pesan.required' => 'Wajib isi Jam Pesan',
            'isi_pesan.required' => 'Wajib isi Pesan yang akan di kirim',
            'tower.required' => 'Wajib isi tower',
            'tower2.required' => 'Wajib isi sampai tower',
            'lantai.required' => 'Wajib isi lantai',
            'lantai2.required' => 'Wajib isi sampai lantai',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {

            $title = $request->title;
            $tgl_pesan = $request->tgl_pesan;
            $jam_pesan = $request->jam_pesan;
            $isi_pesan = $request->isi_pesan;
            $tower = $request->tower;
            $tower2 = $request->tower2;
            $lantai = $request->lantai;
            $lantai2 = $request->lantai2;
            $tgl = explode("-", $tgl_pesan);

            $simpan = [
                'fin_year' => $tgl[0],
                'fin_month' => $tgl[1],
                'title' => $title,
                'tgl_pesan' => $tgl_pesan,
                'jam_pesan' => $jam_pesan,
                'isi_pesan' => $isi_pesan,
                'mintower' => $tower,
                'maxtower' => $tower2,
                'minlantai' => $lantai,
                'maxlantai' => $lantai2
            ];
            // dd($simpan);
            $idnews = RereModel::create($simpan)->id;
            return response()->json([
                'success' => 'Form Isi tersimpan id:' . $idnews . 'Data Tahun' . $tgl[0] . ' bulan' . $tgl[1] . ' Title: ' . $title . ' Tgl_pesan: ' . $tgl_pesan . ' Jam_pesan: ' . $jam_pesan . ' isi_pesan: ' . $isi_pesan . ' tower: ' . $tower . ' dan ' . $tower2 . ' lantai: ' . $lantai . ' sampai ' . $lantai2
            ]);
        }
    }
}
