<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\LaporanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    function index()
    {

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

        $tipe = [
            ['id' => '1', 'name' => 'Invoice'],
            ['id' => '2', 'name' => 'Invoice Reminder 1'],
            ['id' => '3', 'name' => 'Invoice Reminder 2'],
            ['id' => '4', 'name' => 'Invoice Reminder 3'],
            ['id' => '5', 'name' => 'Invoice Reminder 4'],
        ];

        return view('Laporan.index', [
            'username' => Auth::user()->name,
            'title' => 'Laporan Rekap Pengiriman Pesan Blast',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'javascript' => 'Laporan.script'
        ]);
    }
    function json(Request $request)
    {
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $data = new LaporanModel;

        if (isset($request->filter) && $request->filter != null) {
            // $ass = $request->filter;
            $now = Carbon::now();
            $today = $now->format('Y-m-d');
            dd($now->format('Y-m-d'));
            $invoices = $data->getsumarytoday($today);
        } else {
            $invoices = $data->getsumaryoutbox($bulan, $tahun);
        }

        return DataTables::of($invoices)->make(true);
    }
}
