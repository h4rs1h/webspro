<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSP;
use Illuminate\Http\Request;
use App\Imports\InvoiceSPImport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceSPController extends Controller
{
    function index()
    {
        $remin = [
            ['id' => '1', 'name' => 'SP 1'],
            ['id' => '2', 'name' => 'SP 2'],
            ['id' => '3', 'name' => 'SP 3'],
        ];
        $bulan = [
            ['id' => '1', 'name' => 'Januari'],
            ['id' => '2', 'name' => 'Februari'],
            ['id' => '3', 'name' => 'Maret'],
            ['id' => '4', 'name' => 'April'],
            ['id' => '5', 'name' => 'Mei'],
            ['id' => '6', 'name' => 'Juni'],
            ['id' => '7', 'name' => 'Juli'],
            ['id' => '8', 'name' => 'Agustus'],
            ['id' => '9', 'name' => 'September'],
            ['id' => '10', 'name' => 'Oktober'],
            ['id' => '11', 'name' => 'November'],
            ['id' => '12', 'name' => 'Desember'],
        ];
        $tahun = [
            ['id' => '2024', 'name' => '2024'],
            ['id' => '2025', 'name' => '2025'],
            ['id' => '2026', 'name' => '2026'],
        ];

        return view('Collection.invoicesp', [
            'username' => Auth::user()->name,
            'title' => 'Data Invoice SP',
            'reminder_no' => $remin,
            'fin_month' => $bulan,
            'fin_year' => $tahun,
            'javascript' => 'Collection.script',
        ]);
    }
    function invoicespimport(Request $request)
    {
        $validateData = $request->validate([
            'fin_month' => 'required',
            'fin_year' => 'required',
            'reminder_no' => 'required',
            'tgl_cetak' => 'required',
            'tgl_batas_bayar' => 'required',
            'tgl_tempo_awal' => 'required',
            'tgl_tempo_akhir' => 'required'
        ]);
        // dd($request->all());
        $bulan = $request->fin_month;
        $tahun = $request->fin_year;
        $tgl_cetak = $request->tgl_cetak;
        $tgl_batas_bayar = $request->tgl_batas_bayar;
        $tgl_tempo_awal = $request->tgl_tempo_awal;
        $tgl_tempo_akhir = $request->tgl_tempo_akhir;
        $reminder_no = $request->reminder_no;

        // dd($validateData);
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        // $file->move('DataInvoiceSP', $namafile);
        $path = $file->storeAs('DataInvoiceSP', $namafile);
        //dd($namafile, $file, public_path('/DataInvoice/' . $namafile));
        $path = str_replace(public_path(), '', $path);
        Excel::import(new InvoiceSPImport($bulan, $tahun, $tgl_cetak, $tgl_batas_bayar, $tgl_tempo_awal, $tgl_tempo_akhir, $reminder_no, $path /* public_path('storage/DataInvoiceSP/' . $namafile)*/), public_path('storage/DataInvoiceSP/' . $namafile));
        // Excel::import(new InvoiceSPImport(), public_path('/DataInvoiceSP/' . $namafile));
        return redirect('/invoicesp');
    }

    function json()
    {
        $sp = DB::table('vinvoicesp1');
        return DataTables::of($sp)->make(true);
    }
}
