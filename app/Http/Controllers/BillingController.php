<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\lantai;
use App\Models\InvoicePesan;
use Illuminate\Http\Request;

use App\Imports\InvoiceImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class BillingController extends Controller
{
    function index()
    {
        $lantai = lantai::all();
        $tower = DB::select('select distinct tower as id,tower as name from vPecahUnit  order by tower');

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

        return view('Billing.index', [
            'username' => Auth::user()->name,
            'title' => 'Data Invoice Bulanan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tower' => $tower,
            'lantai' => $lantai,
        ]);
    }

    function json(Request $request)
    {
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        // dd($bulan, $tahun);
        $invoices = InvoicePesan::where('fin_year', $tahun)
            ->where('fin_month', $bulan)
            // ->limit(10)
            ->get();
        // Mengembalikan data menggunakan DataTables
        return DataTables::of($invoices)->make(true);
    }

    function preview(Request $request)
    {
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tower = $request->tower;
        $tower2 = $request->tower2;
        $lantai = $request->lantai;
        $lantai2 = $request->lantai2;
        // dd($bulan, $tahun);
        if ($tower == '0' and $tower2 == '0' and $lantai == '0' and $lantai2 == '0') {
            $invoices = InvoicePesan::where('fin_year', $tahun)
                ->where('fin_month', $bulan)
                // ->whereBetween('tower', [$tower, $tower2])
                // ->whereBetween('lantai', [$lantai, $lantai2])
                // ->limit(10)
                ->get();
        } elseif ($tower == '0' and $tower2 == '0' and $lantai != '0' and $lantai2 != '0') {
            $invoices = InvoicePesan::where('fin_year', $tahun)
                ->where('fin_month', $bulan)
                // ->whereBetween('tower', [$tower, $tower2])
                ->whereBetween('lantai', [$lantai, $lantai2])
                // ->limit(10)
                ->get();
        } elseif ($tower !== '0' and $tower2 !== '0' and $lantai == '0' and $lantai2 == '0') {
            $invoices = InvoicePesan::where('fin_year', $tahun)
                ->where('fin_month', $bulan)
                ->whereBetween('tower', [$tower, $tower2])
                // ->whereBetween('lantai', [$lantai, $lantai2])
                // ->limit(10)
                ->get();
        } elseif ($tower != '0' and $tower2 != '0' and $lantai != '0' and $lantai2 != '0') {
            $invoices = InvoicePesan::where('fin_year', $tahun)
                ->where('fin_month', $bulan)
                ->whereBetween('tower', [$tower, $tower2])
                ->whereBetween('lantai', [$lantai, $lantai2])
                // ->limit(10)
                ->get();
        }
        // $invoices = InvoicePesan::where('fin_year', $tahun)
        //     ->where('fin_month', $bulan)
        //     // ->whereBetween('tower', [$tower, $tower2])
        //     // ->whereBetween('lantai', [$lantai, $lantai2])
        //     // ->limit(10)
        //     ->get();
        // Mengembalikan data menggunakan DataTables
        return DataTables::of($invoices)->make(true);
    }
    function proseskirimblast(Request $request)
    {
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tower = $request->tower;
        $tower2 = $request->tower2;
        $lantai = $request->lantai;
        $lantai2 = $request->lantai2;

        $now = Carbon::now();
        $null = 'null';
        $status = 'Prosess';
        $tipe = 'INV';

        // dd($bulan, $tahun);
        if ($tower == '0' and $tower2 == '0' and $lantai == '0' and $lantai2 == '0') {
            $simpan = DB::table('outboxs')->insertUsing(
                ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at'],
                DB::table('vinvoice_pesan')->select([
                    'debtor_acct', 'fin_month', 'fin_year',
                    DB::raw("'" . $now . "' as tglkirim"),
                    DB::raw("null as tglsending"),
                    'hand_phone', 'isi_pesan',
                    DB::raw("'" . $status . "' as status"),
                    DB::raw("'" . $tipe . "' as tipe"),
                    DB::raw("'" . $now . "' as created_at"),
                ])
                    ->where('fin_year', $tahun)
                    ->where('fin_month', $bulan)
                    ->whereNotNull('isi_pesan')
            );
        } elseif ($tower == '0' and $tower2 == '0' and $lantai != '0' and $lantai2 != '0') {
            $simpan = DB::table('outboxs')->insertUsing(
                ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at'],
                DB::table('vinvoice_pesan')->select([
                    'debtor_acct', 'fin_month', 'fin_year',
                    DB::raw("'" . $now . "' as tglkirim"),
                    DB::raw("null as tglsending"),
                    'hand_phone', 'isi_pesan',
                    DB::raw("'" . $status . "' as status"),
                    DB::raw("'" . $tipe . "' as tipe"),
                    DB::raw("'" . $now . "' as created_at"),
                ])
                    ->where('fin_year', $tahun)
                    ->where('fin_month', $bulan)
                    ->whereBetween('lantai', [$lantai, $lantai2])
                    ->whereNotNull('isi_pesan')
            );
        } elseif ($tower !== '0' and $tower2 !== '0' and $lantai == '0' and $lantai2 == '0') {
            $simpan = DB::table('outboxs')->insertUsing(
                ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at'],
                DB::table('vinvoice_pesan')->select([
                    'debtor_acct', 'fin_month', 'fin_year',
                    DB::raw("'" . $now . "' as tglkirim"),
                    DB::raw("null as tglsending"),
                    'hand_phone', 'isi_pesan',
                    DB::raw("'" . $status . "' as status"),
                    DB::raw("'" . $tipe . "' as tipe"),
                    DB::raw("'" . $now . "' as created_at"),
                ])
                    ->where('fin_year', $tahun)
                    ->where('fin_month', $bulan)
                    ->whereBetween('tower', [$tower, $tower2])
                    ->whereNotNull('isi_pesan')
            );
        } elseif ($tower != '0' and $tower2 != '0' and $lantai != '0' and $lantai2 != '0') {
            $simpan = DB::table('outboxs')->insertUsing(
                ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at'],
                DB::table('vinvoice_pesan')->select([
                    'debtor_acct', 'fin_month', 'fin_year',
                    DB::raw("'" . $now . "' as tglkirim"),
                    DB::raw("null as tglsending"),
                    'hand_phone', 'isi_pesan',
                    DB::raw("'" . $status . "' as status"),
                    DB::raw("'" . $tipe . "' as tipe"),
                    DB::raw("'" . $now . "' as created_at"),
                ])
                    ->where('fin_year', $tahun)
                    ->where('fin_month', $bulan)
                    ->whereBetween('tower', [$tower, $tower2])
                    ->whereBetween('lantai', [$lantai, $lantai2])
                    ->whereNotNull('isi_pesan')
            );
        }
        // dd($simpan);
        if ($simpan) {
            // Berhasil

            return response()->json(['message' => 'Proses Kirim Blast Invoce successfully']);
        } else {
            // Gagal

            return response()->json(['message' => 'Gagal menyimpan data ke tabel outboxs.']);
        }
    }
    function import(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataInvoice', $namafile);

        Excel::import(new InvoiceImport(), public_path('/DataInvoice/' . $namafile));
        return response()->json(['message' => 'File has been uploaded and data imported successfully']);
    }
}
