<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\InvoiceSP;
use Illuminate\Http\Request;
use App\Imports\InvoiceSPImport;
use Illuminate\Support\Facades\DB;
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
        $tipe = [
            ['id' => '1', 'name' => 'IPL DC AIR'],
            ['id' => '2', 'name' => 'IPL DC AIR & ASURANSI'],

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
            'tipe_sp' => $tipe,
            'javascript' => 'Collection.script',
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
        $tipe_sp = $request->tipe_sp;
        // dd($bulan, $tahun, $tgl_cetak, $request->sp, $request->tgl_cetak);
        $invsp = new InvoiceSP;

        if (!empty($bulan) and !empty($tahun)) {
            // dd($tahun, $bulan, $reminder_no, $tgl_cetak, $tgl_batas_bayar);
            $invoices = $invsp->getDataSP($tahun, $bulan, $reminder_no, $tgl_cetak, $tgl_batas_bayar, $tipe_sp);
        }
        // else {
        //     $invoices = $invsp->getreminder($reminder_no);
        // }
        dd($invoices);
        return DataTables::of($invoices)->make(true);
    }
    function preview(Request $request)
    {
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $reminder_no = $request->sp;
        $tgl_cetak = $request->tgl_cetak;
        $tgl_batas_bayar = $request->tgl_batas_bayar;
        $tipe_sp = $request->tipe_sp;

        if (isset($request->tipe) && $request->tipe != null) {
            $ass = $request->tipe;
        } else {
            $ass = '';
        }
        // dd($bulan, $tahun, $tgl_cetak, $request->sp, $request->tgl_cetak);
        $invsp = new InvoiceSP;
        if (!empty($bulan) and !empty($tahun)) {
            // dd($tahun, $bulan, $reminder_no, $tgl_cetak, $tgl_batas_bayar);
            $invoices = $invsp->getPreviewDataSP($tahun, $bulan, $reminder_no, $tgl_cetak, $tgl_batas_bayar, $tipe_sp, $ass);
        } else {
            $invoices = $invsp->getreminder($reminder_no);
        }
        // dd($invoices);
        return DataTables::of($invoices)->make(true);
    }
    function proseskirimblastsp(Request $request)
    {
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $reminder_no = $request->sp;
        $tgl_cetak = $request->tgl_cetak;
        $tgl_batas_bayar = $request->tgl_batas_bayar;
        $tipe_sp = $request->tipe_sp;

        $now = Carbon::now();
        $null = 'null';
        $status = 'Prosess';
        $tipe = 'SP' . $reminder_no;

        if (isset($request->tipe) && $request->tipe != null) {
            $ass = $request->tipe;
        } else {
            $ass = '';
        }

        // dd($bulan, $tahun, $tgl_cetak, $tgl_batas_bayar, $reminder_no);
        if ($reminder_no == '1') {
            if ($tipe_sp == '1') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoicesp1')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'wa', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        'reminder_no'
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereNotNull('wa')
                        ->where('tgl_cetak', $tgl_cetak)
                );
            } else {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoicesp1_ass')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'wa', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        'reminder_no'
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereNotNull('wa')
                        ->where('tgl_cetak', $tgl_cetak)
                );
            }
        } elseif ($reminder_no == '2') {
            if ($tipe_sp == '1') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoicesp2')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'wa', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        'reminder_no'
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereNotNull('wa')
                        ->where('tgl_cetak', $tgl_cetak)
                );
            } else {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoicesp2_ass')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'wa', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        'reminder_no'
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereNotNull('wa')
                        ->where('tgl_cetak', $tgl_cetak)
                );
            }
        } elseif ($reminder_no == '3') {
            if ($tipe_sp == '1') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoicesp3')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'wa', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        'reminder_no'
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereNotNull('wa')
                        ->where('tgl_cetak', $tgl_cetak)
                );
            } else {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoicesp3_ass')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'wa', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        'reminder_no'
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereNotNull('wa')
                        ->where('tgl_cetak', $tgl_cetak)
                );
            }
        }
        // dd($simpan);
        if ($simpan) {
            // Berhasil

            return response()->json([
                'remove' => 'alert-danger',
                'add' => 'alert-success',
                'message' => 'Proses Kirim Blast SP  successfully'
            ]);
        } else {
            // Gagal

            return response()->json([
                'add' => 'alert-danger',
                'remove' => 'alert-success',
                'message' => 'Gagal menyimpan data Blast ke tabel outboxs.'
            ]);
        }
    }
    function upload(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'fin_month' => 'required',
            'fin_year' => 'required',
            'tipe_sp' => 'required',
            'tgl_cetak' => 'required',
            'tgl_batas_bayar' => 'required',
            'file' => 'required|file|mimes:xls,xlsx',
        ]);
        // dd($request->all());
        $bulan = $request->fin_month;
        $tahun = $request->fin_year;
        $tgl_cetak = $request->tgl_cetak;
        $tgl_batas_bayar = $request->tgl_batas_bayar;
        $tipe_sp = $request->tipe_sp;

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
        Excel::import(new InvoiceSPImport($bulan, $tahun, $tgl_cetak, $tgl_batas_bayar, $tgl_tempo_awal, $tgl_tempo_akhir, $reminder_no, $tipe_sp, $reminder_no_ass, $path /* public_path('storage/DataInvoiceSP/' . $namafile)*/), public_path('storage/DataInvoiceSP/' . $namafile));
        // Excel::import(new InvoiceSPImport(), public_path('/DataInvoiceSP/' . $namafile));
        // return redirect('/invoicesp');
        return response()->json([
            'remove' => 'alert-danger',
            'add' => 'alert-success', 'message' => 'File ' . $namafile . ' has been uploaded and data imported successfully'
        ]);
    }
}
