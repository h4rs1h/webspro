<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSP;
use Illuminate\Http\Request;
use App\Imports\InvoiceSPImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class CollectionController extends Controller
{
    function index(Request $request)
    {

        $remin = [
            ['id' => '1', 'name' => 'Reminder 1'],
            ['id' => '2', 'name' => 'Reminder 2'],
            ['id' => '3', 'name' => 'Reminder 3'],
            ['id' => '4', 'name' => 'Reminder 4'],
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
        if ($request->sp != 'asuransi') {
            $subTitle = 'Form Filter Data Invoice SP ' . $request->sp;
        } else {
            $subTitle = 'Form Filter Data SP ' . $request->sp;
        }
        return view('Collection.index', [
            'username' => Auth::user()->name,
            'title' => 'Data Invoice SP ' . $request->sp,
            'title_form_filter' => $subTitle,
            'reminder' => $request->sp,
            'reminder_no' => $remin,
            'fin_month' => $bulan,
            'fin_year' => $tahun,
            'javascript' => 'collection.script',
        ]);
    }
    function json(Request $request)
    {
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $reminder_no = $request->sp;
        $tgl_cetak = $request->tgl_cetak;
        $tgl_batas_bayar = $request->tgl_batas_bayar;
        // dd($bulan, $tahun);
        $invsp = new InvoiceSP;
        if (!empty($bulan) and !empty($tahun)) {
            $invoices = $invsp->getDataSP($tahun, $bulan, $reminder_no, $tgl_cetak, $tgl_batas_bayar);
        } else {
            $invoices = $invsp->getreminder($reminder_no);
        }
        // dd($invoices);
        return DataTables::of($invoices)->make(true);
    }
    function upload(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'fin_month' => 'required',
            'fin_year' => 'required',
            'tgl_cetak' => 'required',
            'tgl_batas_bayar' => 'required',
            'file' => 'required|file|mimes:xls,xlsx',
        ]);
        // dd($request->all());
        $bulan = $request->fin_month;
        $tahun = $request->fin_year;
        $tgl_cetak = $request->tgl_cetak;
        $tgl_batas_bayar = $request->tgl_batas_bayar;

        $reminder_no = $request->reminder_no;
        $reminder_no_ass = $request->reminder_no_ass;

        if ($reminder_no == 1) {
            $tgl_tempo_awal = $request->tgl_batas_bayar;
            $tgl_tempo_akhir = $request->tgl_batas_bayar;
        } elseif ($reminder_no == 'asuransi') {
            $tgl_tempo_awal = $request->tgl_tempo_akhir;
            $tgl_tempo_akhir = $request->tgl_tempo_akhir;
        } else {
            $tgl_tempo_awal = $request->tgl_tempo_awal;
            $tgl_tempo_akhir = $request->tgl_tempo_akhir;
        }

        // dd($validateData);
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        // $file->move('DataInvoiceSP', $namafile);
        $path = $file->storeAs('DataInvoiceSP', $namafile);
        //dd($namafile, $file, public_path('/DataInvoice/' . $namafile));
        $path = str_replace(public_path(), '', $path);
        Excel::import(new InvoiceSPImport($bulan, $tahun, $tgl_cetak, $tgl_batas_bayar, $tgl_tempo_awal, $tgl_tempo_akhir, $reminder_no, $reminder_no_ass, $path /* public_path('storage/DataInvoiceSP/' . $namafile)*/), public_path('storage/DataInvoiceSP/' . $namafile));
        // Excel::import(new InvoiceSPImport(), public_path('/DataInvoiceSP/' . $namafile));
        // return redirect('/invoicesp');
        return response()->json([
            'remove' => 'alert-danger',
            'add' => 'alert-success', 'message' => 'File ' . $namafile . ' has been uploaded and data imported successfully'
        ]);
    }
}
