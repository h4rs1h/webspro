<?php

namespace App\Http\Controllers;

use App\Models\lantai;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Imports\InvoiceImport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class InvoiceController extends Controller
{
    function index()
    {
        $lt = lantai::all();
        $tower = DB::select('select distinct tower as id,tower as name from vPecahUnit  order by tower');
        $block = DB::select('select distinct blok as block from vPecahUnit order by blok');
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
        // dd($tower, $lt);
        return view('Billing.invoice.form_filter', [
            'username' => Auth::user()->name,
            'title' => 'Filter Form Invoice Bulanan',
            'aksi' => 'invoice.getdata',
            'tahun' => $tahun,
            'bulan' => $bulan,
            'tower' => $tower,
            'lantai' => $lt,
            'block' => $block,
        ]);
    }
    function getdata(Request $request)
    {

        $validateData = $request->validate([
            'fin_year' => 'required|integer',
            'fin_month' => 'required|integer',
            'tower' => 'required',
            'tower2' => ['required'],
            'lantai' => 'required',
            'lantai2' => ['required'],
            'block' => 'required',
            'block2' => 'required'
        ]);
        // dd($request->tower, $request->tower2);
        if ($request->tower == '0' and $request->lantai == '0' and $request->block == '0') {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->get();
        } elseif ($request->tower == '0' and $request->block == '0') {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->whereBetween('vPecahUnit.lantai', [$request->lantai, $request->lantai2])
                ->get();
        } elseif ($request->lantai == '0' and $request->block == '0') {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->whereBetween('vPecahUnit.tower', [$request->tower, $request->tower2])
                ->get();
        } elseif ($request->block == '0') {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->whereBetween('vPecahUnit.tower', [$request->tower, $request->tower2])
                ->whereBetween('vPecahUnit.lantai', [$request->lantai, $request->lantai2])
                ->get();
        } else {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->whereBetween('vPecahUnit.tower', [$request->tower, $request->tower2])
                ->whereBetween('vPecahUnit.lantai', [$request->lantai, $request->lantai2])
                ->whereBetween('vPecahUnit.blok', [$request->block, $request->block2])
                ->get();
        }
        // dd($data, $request->block, $request->lantai, $request->tower, $request->tower2);
        return view('Billing.invoice.get_data_inv', [
            'username' => Auth::user()->name,
            'title' => 'Invoice Bulan : ' . $request->fin_month . ' Tahun: ' . $request->fin_year,
            'fin_year' => $request->fin_year,
            'fin_month' => $request->fin_month,
            'tower' => $request->tower,
            'tower2' => $request->tower2,
            'lantai' => $request->lantai,
            'lantai2' => $request->lantai2,
            'block' => $request->block,
            'block2' => $request->block2,
            'data' => $data
        ]);
    }
    function prosesBlast()
    {
        $lt = lantai::all();
        $tower = DB::select('select distinct tower as id,tower as name from vPecahUnit  order by tower');
        $block = DB::select('select distinct blok as block from vPecahUnit order by blok');
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
        // dd($tower, $lt);
        return view('Billing.invoice.form_filter', [
            'username' => Auth::user()->name,
            'title' => 'Filter Form Proses Kirim Blast Invoice Bulanan',
            'aksi' => 'invoice.blast.getdata',
            'tahun' => $tahun,
            'bulan' => $bulan,
            'tower' => $tower,
            'lantai' => $lt,
            'block' => $block,
        ]);
    }
    function getproses(Request $request)
    {

        $validateData = $request->validate([
            'fin_year' => 'required|integer',
            'fin_month' => 'required|integer',
            'tower' => 'required',
            'tower2' => ['required'],
            'lantai' => 'required',
            'lantai2' => ['required'],
            'block' => 'required',
            'block2' => 'required'
        ]);
        // dd($request->all(), $request->tower, $request->tower2);
        if ($request->tower == '0' and $request->lantai == '0' and $request->block == '0') {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->join('outboxs', function ($join) {
                    $join->on('vinvoice_pesan.debtor_acct', '=', 'outboxs.debtor_acct')
                        ->where('vinvoice_pesan.fin_month', '=', 'outboxs.fin_month')
                        ->where('vinvoice_pesan.fin_year', '=', 'outboxs.fin_year')
                        ->where('outboxs.tipe', '=', 'inv');
                })
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai', 'outboxs.status')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->get();
        } elseif ($request->lantai == '0' and $request->block == '0') {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->join('outboxs', function ($join) {
                    $join->on('vinvoice_pesan.debtor_acct', '=', 'outboxs.debtor_acct')
                        ->where('vinvoice_pesan.fin_month', '=', 'outboxs.fin_month')
                        ->where('vinvoice_pesan.fin_year', '=', 'outboxs.fin_year')
                        ->where('outboxs.tipe', '=', 'inv');
                })
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai', 'outboxs.status')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->whereBetween('vPecahUnit.tower', [$request->tower, $request->tower2])
                ->get();
        } elseif ($request->tower == '0' and $request->block == '0') {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->join('outboxs', function ($join) {
                    $join->on('vinvoice_pesan.debtor_acct', '=', 'outboxs.debtor_acct')
                        ->where('vinvoice_pesan.fin_month', '=', 'outboxs.fin_month')
                        ->where('vinvoice_pesan.fin_year', '=', 'outboxs.fin_year')
                        ->where('outboxs.tipe', '=', 'inv');
                })
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai', 'outboxs.status')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->whereBetween('vPecahUnit.lantai', [$request->lantai, $request->lantai2])
                ->get();
        } elseif ($request->block == '0') {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->join('outboxs', function ($join) {
                    $join->on('vinvoice_pesan.debtor_acct', '=', 'outboxs.debtor_acct')
                        ->where('vinvoice_pesan.fin_month', '=', 'outboxs.fin_month')
                        ->where('vinvoice_pesan.fin_year', '=', 'outboxs.fin_year')
                        ->where('outboxs.tipe', '=', 'inv');
                })
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai', 'outboxs.status')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->whereBetween('vPecahUnit.tower', [$request->tower, $request->tower2])
                ->whereBetween('vPecahUnit.lantai', [$request->lantai, $request->lantai2])
                ->get();
        } else {
            $data = DB::table('vinvoice_pesan')
                ->join('vPecahUnit', 'vPecahUnit.business_id', '=', 'vinvoice_pesan.debtor_acct')
                ->join('outboxs', function ($join) {
                    $join->on('vinvoice_pesan.debtor_acct', '=', 'outboxs.debtor_acct')
                        ->where('vinvoice_pesan.fin_month', '=', 'outboxs.fin_month')
                        ->where('vinvoice_pesan.fin_year', '=', 'outboxs.fin_year')
                        ->where('outboxs.tipe', '=', 'inv');
                })
                ->select('vinvoice_pesan.*', 'vPecahUnit.tower', 'vPecahUnit.blok', 'vPecahUnit.lantai', 'outboxs.status')
                ->where('vinvoice_pesan.fin_year', $request->fin_year)
                ->where('vinvoice_pesan.fin_month', $request->fin_month)
                ->whereBetween('vPecahUnit.tower', [$request->tower, $request->tower2])
                ->whereBetween('vPecahUnit.lantai', [$request->lantai, $request->lantai2])
                ->whereBetween('vPecahUnit.blok', [$request->block, $request->block2])
                ->get();
        }
        // dd($data, $request->block, $request->lantai, $request->tower, $request->tower2);
        return view('Billing.invoice.getProsesBlast_inv', [
            'username' => Auth::user()->name,
            'title' => 'Proses Blast Invoice Bulan : ' . $request->fin_month . ' Tahun: ' . $request->fin_year,
            'fin_year' => $request->fin_year,
            'fin_month' => $request->fin_month,
            'tower' => $request->tower,
            'tower2' => $request->tower2,
            'lantai' => $request->lantai,
            'lantai2' => $request->lantai2,
            'block' => $request->block,
            'block2' => $request->block2,
            'data' => $data
        ]);
    }
    function tampil()
    {

        return view('Billing.invoice.getDataInv', [
            'username' => Auth::user()->name,
            'title' => 'Data Invoice',
            'data' => [],
        ]);
    }
    function getjson()
    {
        return DataTables::of(invoice::limit(10))->make(true);
    }
    function json()
    {
        return DataTables::of(invoice::limit(10))->make(true);
    }
    function invoiceImport(Request $request)
    {
        // dd($request);
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataInvoice', $namafile);
        // dd($namafile, $file, public_path('/DataInvoice/' . $namafile));
        Excel::import(new InvoiceImport(), public_path('/DataInvoice/' . $namafile));
        return redirect('/invoice');
    }
}
