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
use Illuminate\Support\Facades\Validator;

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
        $invsp = new InvoiceSP;

        if ($request->draw > 1) {
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $reminder_no = $request->reminder_no;
            $tipe_sp = $request->tipe_sp;
            $tgl_cetak = $request->tgl_cetak;
            $tgl_batas_bayar = $request->tgl_batas_bayar;

            $invoices = $invsp->getDataSP($tahun, $bulan, $reminder_no, $tgl_cetak, $tgl_batas_bayar, $tipe_sp);
        } else {
            $invoices = $invsp->getDataAwal($request->sp);
        }

        return DataTables::of($invoices)
            ->addIndexColumn()
            ->make(true);
    }
    function preview(Request $request)
    {
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $reminder_no = $request->reminder_no;
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
        return DataTables::of($invoices)
            ->addIndexColumn()
            ->make(true);
    }
    function proseskirimblastsp(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'fin_year' => 'required',
            'fin_month' => 'required',
            'tipe_sp' => 'required',
            'tgl_cetak' => 'required',
            'tgl_batas_bayar' => 'required',

        ], [
            'fin_year.required' => 'Wajib isi tahun',
            'fin_month.required' => 'Wajib isi bulan',
            'tipe_sp.required' => 'Wajib isi Tipe SP',
            'tgl_cetak.required' => 'Wajib isi Tanggal Kirim',
            'tgl_batas_bayar.required' => 'Wajib isi Tanggal Batas Bayar',

        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $bulan = $request->fin_month;
            $tahun = $request->fin_year;
            $reminder_no = $request->reminder_no;
            $tgl_cetak = $request->tgl_cetak;
            $tgl_batas_bayar = $request->tgl_batas_bayar;
            $tipe_sp = $request->tipe_sp;

            if (isset($request->tipe) && $request->tipe != null) {
                $ass = $request->tipe;
            } else {
                $ass = '';
            }
            $hasil = DB::select("call get_proses_sp('" . $tahun . "','" . $bulan . "','" . $reminder_no . "','" . $tgl_cetak . "','" . $tgl_batas_bayar . "','" . $tipe_sp . "')");
            foreach ($hasil as $h) {
                $simpan = $h->jmlproses;
            }

            if ($simpan > 0) {
                return response()->json(['success' => 'Sukses memproses sebanyak ' . $simpan . ' data, bulan: ' . $bulan . ' tahun: ' . $tahun . 'reminder_no:' . $reminder_no . ' tipe_sp:' . $tipe_sp . ' tgl_cetak:' . $tgl_cetak . ' tgl_batas_bayar :' . $tgl_batas_bayar . ' Proses kirim SP sudah dilakukan, silahkan cek menu outbox.']);
            } else {
                return response()->json(['errors' => ['file' => $simpan . ' Gagal menyimpan data Blast ke tabel outboxs.']]);
                // return response()->json(['errors' => 'Gagal menyimpan data Blast ke tabel outboxs.']);
            }
        }
    }
    function proseskirimblastsp_sample(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'fin_year' => 'required',
            'fin_month' => 'required',
            'tipe_sp' => 'required',
            'tgl_cetak' => 'required',
            'tgl_batas_bayar' => 'required',

        ], [
            'fin_year.required' => 'Wajib isi tahun',
            'fin_month.required' => 'Wajib isi bulan',
            'tipe_sp.required' => 'Wajib isi Tipe SP',
            'tgl_cetak.required' => 'Wajib isi Tanggal Kirim',
            'tgl_batas_bayar.required' => 'Wajib isi Tanggal Batas Bayar',

        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $bulan = $request->fin_month;
            $tahun = $request->fin_year;
            $reminder_no = $request->reminder_no;
            $tgl_cetak = $request->tgl_cetak;
            $tgl_batas_bayar = $request->tgl_batas_bayar;
            $tipe_sp = $request->tipe_sp;

            if (isset($request->tipe) && $request->tipe != null) {
                $ass = $request->tipe;
            } else {
                $ass = '';
            }
            $hasil = DB::select("call get_proses_sp_sampel('" . $tahun . "','" . $bulan . "','" . $reminder_no . "','" . $tgl_cetak . "','" . $tgl_batas_bayar . "','" . $tipe_sp . "')");
            foreach ($hasil as $h) {
                $simpan = $h->jmlproses;
            }

            if ($simpan > 0) {
                return response()->json(['success' => 'Sukses memproses sebanyak ' . $simpan . ' data, bulan: ' . $bulan . ' tahun: ' . $tahun . 'reminder_no:' . $reminder_no . ' tipe_sp:' . $tipe_sp . ' tgl_cetak:' . $tgl_cetak . ' tgl_batas_bayar :' . $tgl_batas_bayar . ' Proses kirim SP sudah dilakukan, silahkan cek menu outbox.']);
            } else {
                return response()->json(['errors' => ['file' => $simpan . ' Gagal menyimpan data Blast ke tabel outboxs.']]);
                // return response()->json(['errors' => 'Gagal menyimpan data Blast ke tabel outboxs.']);
            }
        }
    }
    function upload(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'fin_year' => 'required',
            'fin_month' => 'required',
            'tipe_sp' => 'required',
            'tgl_cetak' => 'required',
            'tgl_batas_bayar' => 'required',
            'file' => 'required|file|mimes:xls,xlsx',
        ], [
            'fin_year.required' => 'Wajib isi tahun',
            'fin_month.required' => 'Wajib isi bulan',
            'tipe_sp.required' => 'Wajib isi Tipe SP',
            'tgl_cetak.required' => 'Wajib isi Tanggal Kirim',
            'tgl_batas_bayar.required' => 'Wajib isi Tanggal Batas Bayar',
            'file.required' => 'File wajib diisi',
            'file.mimes' => 'Format file wajib xls atau xlsx',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {

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


            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();
            // $file->move('DataInvoiceSP', $namafile);
            $path = $file->storeAs('DataInvoiceSP', $namafile);

            $path = str_replace(public_path(), '', $path);
            Excel::import(new InvoiceSPImport($bulan, $tahun, $tgl_cetak, $tgl_batas_bayar, $tgl_tempo_awal, $tgl_tempo_akhir, $reminder_no, $tipe_sp, $reminder_no_ass, $path /* public_path('storage/DataInvoiceSP/' . $namafile)*/), public_path('storage/DataInvoiceSP/' . $namafile));
            // Excel::import(new InvoiceSPImport(), public_path('/DataInvoiceSP/' . $namafile));

            return response()->json(['success' => 'File ' . $namafile . ' successfully upload, silahkan tunggu proses import data disistem.']);
        }
    }
    function getpreview(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'fin_year' => 'required',
            'fin_month' => 'required',
            'tipe_sp' => 'required',
            'tgl_cetak' => 'required',
            'tgl_batas_bayar' => 'required',

        ], [
            'fin_year.required' => 'Wajib isi tahun',
            'fin_month.required' => 'Wajib isi bulan',
            'tipe_sp.required' => 'Wajib isi Tipe SP',
            'tgl_cetak.required' => 'Wajib isi Tanggal Kirim',
            'tgl_batas_bayar.required' => 'Wajib isi Tanggal Batas Bayar',

        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            return response()->json(['success' => 'Preview Berhasil, silahkan tutup form untuk melihat detail data']);
        }
    }
}
