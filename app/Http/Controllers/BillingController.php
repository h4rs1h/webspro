<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\lantai;
use App\Jobs\ImportFile;
use App\Models\InvoicePesan;

use Illuminate\Http\Request;
use App\Imports\InvoiceImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\ImportOutstandingInvoice;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\InvoiceOutstandingImport;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    function index()
    {
        $remin = [
            ['id' => '1', 'name' => 'Reminder 1'],
            ['id' => '2', 'name' => 'Reminder 2'],
            ['id' => '3', 'name' => 'Reminder 3'],
            ['id' => '4', 'name' => 'Reminder 4'],
        ];

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

        return view('Billing.index', [
            'username' => Auth::user()->name,
            'title' => 'Data Invoice Bulanan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tower' => $tower,
            'lantai' => $lantai,
            'reminder_no' => $remin,
            'javascript' => 'Billing.script'
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
        return DataTables::of($invoices)
            ->addIndexColumn()
            ->make(true);
    }

    function json_reminder(Request $request)
    {
        // dd($request->all());
        $fin_month = $request->bulan;
        $fin_year = $request->tahun;
        $reminder_no = $request->reminder_no;

        $invoices_reminder = new InvoicePesan;
        $invoices = $invoices_reminder->getDataInvoiceReminder($fin_year, $fin_month, $reminder_no);

        return DataTables::of($invoices)
            ->addIndexColumn()
            ->make(true);
    }


    function getpreview(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'fin_tahun' => 'required',
            'fin_bulan' => 'required',
            'tower' => 'required',
            'tower2' => 'required',
            'lantai' => 'required',
            'lantai2' => 'required',
            'reminder_no' => 'required',
        ], [
            'fin_tahun.required' => 'Wajib isi tahun',
            'fin_bulan.required' => 'Wajib isi bulan',
            'tower.required' => 'Wajib isi tower',
            'tower2.required' => 'Wajib isi sampai tower',
            'lantai.required' => 'Wajib isi lantai',
            'lantai2.required' => 'Wajib isi sampai lantai',
            'reminder_no.required' => 'Wajib isi tipe blast',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {

            $bulan = $request->fin_bulan;
            $tahun = $request->fin_tahun;
            $tower = $request->tower;
            $tower2 = $request->tower2;
            $lantai = $request->lantai;
            $lantai2 = $request->lantai2;
            $reminder_no = $request->reminder_no;
            return response()->json([
                'success' => 'Filter Data Tahun: ' . $tahun . ' Bulan: ' . $bulan . ' tower: ' . $tower . ' dan ' . $tower2 . ' lantai: ' . $lantai . ' sampai ' . $lantai2 . ' untuk reminder ' . $reminder_no,
            ]);
        }
    }

    function preview(Request $request)
    {
        $bulan = $request->fin_bulan;
        $tahun = $request->fin_tahun;
        $tower = $request->tower;
        $tower2 = $request->tower2;
        $lantai = $request->lantai;
        $lantai2 = $request->lantai2;
        $reminder_no = $request->reminder_no;

        if ($tower == '0' and $tower2 == '0' and $lantai == '0' and $lantai2 == '0') {
            $invoices = InvoicePesan::where('fin_year', $tahun)
                ->where('fin_month', $bulan)
                ->where('reminder_no', $reminder_no)
                // ->whereBetween('tower', [$tower, $tower2])
                // ->whereBetween('lantai', [$lantai, $lantai2])
                // ->limit(10)
                ->get();
        } elseif ($tower == '0' and $tower2 == '0' and $lantai != '0' and $lantai2 != '0') {
            $invoices = InvoicePesan::where('fin_year', $tahun)
                ->where('fin_month', $bulan)
                // ->whereBetween('tower', [$tower, $tower2])
                ->whereBetween('lantai', [$lantai, $lantai2])
                ->where('reminder_no', $reminder_no)
                // ->limit(10)
                ->get();
        } elseif ($tower !== '0' and $tower2 !== '0' and $lantai == '0' and $lantai2 == '0') {
            $invoices = InvoicePesan::where('fin_year', $tahun)
                ->where('fin_month', $bulan)
                ->whereBetween('tower', [$tower, $tower2])
                ->where('reminder_no', $reminder_no)
                // ->whereBetween('lantai', [$lantai, $lantai2])
                // ->limit(10)
                ->get();
        } elseif ($tower != '0' and $tower2 != '0' and $lantai != '0' and $lantai2 != '0') {
            $invoices = InvoicePesan::where('fin_year', $tahun)
                ->where('fin_month', $bulan)
                ->whereBetween('tower', [$tower, $tower2])
                ->whereBetween('lantai', [$lantai, $lantai2])
                ->where('reminder_no', $reminder_no)
                // ->limit(10)
                ->get();
        }

        return DataTables::of($invoices)
            ->addIndexColumn()
            ->make(true);
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
        $reminder_no = $request->reminder_no;

        $now = Carbon::now();
        $null = 'null';
        $status = 'Prosess';
        $tipe = 'INV';

        // dd($bulan, $tahun);
        if ($reminder_no == '0') {

            if ($tower == '0' and $tower2 == '0' and $lantai == '0' and $lantai2 == '0') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoice_pesan')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'hand_phone', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        DB::raw("'0' as reminder_no"),
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereNotNull('isi_pesan')
                );
            } elseif ($tower == '0' and $tower2 == '0' and $lantai != '0' and $lantai2 != '0') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoice_pesan')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'hand_phone', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        DB::raw("'0' as reminder_no"),
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereBetween('lantai', [$lantai, $lantai2])
                        ->whereNotNull('isi_pesan')
                );
            } elseif ($tower !== '0' and $tower2 !== '0' and $lantai == '0' and $lantai2 == '0') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoice_pesan')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'hand_phone', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        DB::raw("'0' as reminder_no"),
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereBetween('tower', [$tower, $tower2])
                        ->whereNotNull('isi_pesan')
                );
            } elseif ($tower != '0' and $tower2 != '0' and $lantai != '0' and $lantai2 != '0') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoice_pesan')->select([
                        'debtor_acct', 'fin_month', 'fin_year',
                        DB::raw("'" . $now . "' as tglkirim"),
                        DB::raw("null as tglsending"),
                        'hand_phone', 'isi_pesan',
                        DB::raw("'" . $status . "' as status"),
                        DB::raw("'" . $tipe . "' as tipe"),
                        DB::raw("'" . $now . "' as created_at"),
                        DB::raw("'0' as reminder_no"),
                    ])
                        ->where('fin_year', $tahun)
                        ->where('fin_month', $bulan)
                        ->whereBetween('tower', [$tower, $tower2])
                        ->whereBetween('lantai', [$lantai, $lantai2])
                        ->whereNotNull('isi_pesan')
                );
            }
        } else {
            if ($tower == '0' and $tower2 == '0' and $lantai == '0' and $lantai2 == '0') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoice_pesan')
                        ->join('invoice_reminder', function ($join) {
                            $join->on('vinvoice_pesan.fin_year', '=', 'invoice_reminder.fin_year')
                                ->on('vinvoice_pesan.fin_month', '=', 'invoice_reminder.fin_month')
                                ->on('vinvoice_pesan.debtor_acct', '=', 'invoice_reminder.debtor_acct');
                        })
                        ->select([
                            'vinvoice_pesan.debtor_acct', 'vinvoice_pesan.fin_month', 'vinvoice_pesan.fin_year',
                            DB::raw("'" . $now . "' as tglkirim"),
                            DB::raw("null as tglsending"),
                            'vinvoice_pesan.hand_phone', 'vinvoice_pesan.isi_pesan',
                            DB::raw("'" . $status . "' as status"),
                            DB::raw("'" . $tipe . "' as tipe"),
                            DB::raw("'" . $now . "' as created_at"),
                            'invoice_reminder.reminder_no'
                        ])
                        ->where('vinvoice_pesan.fin_year', $tahun)
                        ->where('vinvoice_pesan.fin_month', $bulan)
                        ->whereNotNull('vinvoice_pesan.isi_pesan')
                        ->where('invoice_reminder.reminder_no', $reminder_no)
                );
            } elseif ($tower == '0' and $tower2 == '0' and $lantai != '0' and $lantai2 != '0') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoice_pesan')
                        ->join('invoice_reminder', function ($join) {
                            $join->on('vinvoice_pesan.fin_year', '=', 'invoice_reminder.fin_year')
                                ->on('vinvoice_pesan.fin_month', '=', 'invoice_reminder.fin_month')
                                ->on('vinvoice_pesan.debtor_acct', '=', 'invoice_reminder.debtor_acct');
                        })
                        ->select([
                            'vinvoice_pesan.debtor_acct', 'vinvoice_pesan.fin_month', 'vinvoice_pesan.fin_year',
                            DB::raw("'" . $now . "' as tglkirim"),
                            DB::raw("null as tglsending"),
                            'vinvoice_pesan.hand_phone', 'vinvoice_pesan.isi_pesan',
                            DB::raw("'" . $status . "' as status"),
                            DB::raw("'" . $tipe . "' as tipe"),
                            DB::raw("'" . $now . "' as created_at"),
                            'invoice_reminder.reminder_no'
                        ])
                        ->where('vinvoice_pesan.fin_year', $tahun)
                        ->where('vinvoice_pesan.fin_month', $bulan)
                        ->whereBetween('vinvoice_pesan.lantai', [$lantai, $lantai2])
                        ->whereNotNull('vinvoice_pesan.isi_pesan')
                        ->where('invoice_reminder.reminder_no', $reminder_no)
                );
            } elseif ($tower !== '0' and $tower2 !== '0' and $lantai == '0' and $lantai2 == '0') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoice_pesan')
                        ->join('invoice_reminder', function ($join) {
                            $join->on('vinvoice_pesan.fin_year', '=', 'invoice_reminder.fin_year')
                                ->on('vinvoice_pesan.fin_month', '=', 'invoice_reminder.fin_month')
                                ->on('vinvoice_pesan.debtor_acct', '=', 'invoice_reminder.debtor_acct');
                        })
                        ->select([
                            'vinvoice_pesan.debtor_acct', 'vinvoice_pesan.fin_month', 'vinvoice_pesan.fin_year',
                            DB::raw("'" . $now . "' as tglkirim"),
                            DB::raw("null as tglsending"),
                            'vinvoice_pesan.hand_phone', 'vinvoice_pesan.isi_pesan',
                            DB::raw("'" . $status . "' as status"),
                            DB::raw("'" . $tipe . "' as tipe"),
                            DB::raw("'" . $now . "' as created_at"),
                            'invoice_reminder.reminder_no'
                        ])
                        ->where('vinvoice_pesan.fin_year', $tahun)
                        ->where('vinvoice_pesan.fin_month', $bulan)
                        ->whereBetween('vinvoice_pesan.tower', [$tower, $tower2])
                        ->whereNotNull('vinvoice_pesan.isi_pesan')
                        ->where('invoice_reminder.reminder_no', $reminder_no)
                );
            } elseif ($tower != '0' and $tower2 != '0' and $lantai != '0' and $lantai2 != '0') {
                $simpan = DB::table('outboxs')->insertUsing(
                    ['debtor_acct', 'fin_month', 'fin_year', 'tglKirim', 'tglsending', 'wa', 'pesan', 'status', 'tipe', 'created_at', 'reminder_no'],
                    DB::table('vinvoice_pesan')
                        ->join('invoice_reminder', function ($join) {
                            $join->on('vinvoice_pesan.fin_year', '=', 'invoice_reminder.fin_year')
                                ->on('vinvoice_pesan.fin_month', '=', 'invoice_reminder.fin_month')
                                ->on('vinvoice_pesan.debtor_acct', '=', 'invoice_reminder.debtor_acct');
                        })
                        ->select([
                            'vinvoice_pesan.debtor_acct', 'vinvoice_pesan.fin_month', 'vinvoice_pesan.fin_year',
                            DB::raw("'" . $now . "' as tglkirim"),
                            DB::raw("null as tglsending"),
                            'vinvoice_pesan.hand_phone', 'vinvoice_pesan.isi_pesan',
                            DB::raw("'" . $status . "' as status"),
                            DB::raw("'" . $tipe . "' as tipe"),
                            DB::raw("'" . $now . "' as created_at"),
                            'invoice_reminder.reminder_no'
                        ])
                        ->where('vinvoice_pesan.fin_year', $tahun)
                        ->where('vinvoice_pesan.fin_month', $bulan)
                        ->whereBetween('vinvoice_pesan.tower', [$tower, $tower2])
                        ->whereBetween('vinvoice_pesan.lantai', [$lantai, $lantai2])
                        ->whereNotNull('vinvoice_pesan.isi_pesan')
                        ->where('invoice_reminder.reminder_no', $reminder_no)
                );
            }
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

        $validasi = Validator::make($request->all(), [
            'fin_year' => 'required',
            'fin_month' => 'required',
            'file' => 'required|file|mimes:xls,xlsx',
        ], [
            'fin_year.required' => 'Wajib isi tahun',
            'fin_month.required' => 'Wajib isi bulan',
            'file.required' => 'File wajib diisi',
            'file.mimes' => 'Format file wajib xls atau xlsx',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {

            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();

            // Periksa apakah nama file sudah ada
            if (Storage::exists('DataInvoice/' . $namafile)) {
                return response()->json(['errors' => ['file' => 'File ' . $namafile . ' sudah diupload, lanjutkan ke file lain']]);
            }

            $file->storeAs('DataInvoice', $namafile);

            // ImportFile::dispatch(public_path('storage/DataInvoice/' . $namafile))->onQueue('whatsappBlast');
            Excel::import(new InvoiceImport(), public_path('storage/DataInvoice/' . $namafile));
            return response()->json(['success' => 'File ' . $namafile . ' has been uploaded and data imported successfully']);
        }
    }
    function import_outstanding(Request $request)
    {
        // penambahan fungsi disini untuk penympanan upload file excel outstanding inv

        $validasi = Validator::make($request->all(), [
            'fin_month' => 'required',
            'fin_year' => 'required',
            'reminder_no' => 'required',
            'file' => 'required|file|mimes:xls,xlsx'
        ], [
            'fin_month.required' => 'Wajib isi bulan',
            'fin_year.required' => 'Wajib isi tahun',
            'reminder_no.required' => 'Wajib isi reminder no',
            'file.required' => 'File wajib diisi',
            'file.mimes' => 'Format file wajib xls atau xlsx',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {

            $bulan = $request->fin_month;
            $tahun = $request->fin_year;
            $reminder_no = $request->reminder_no;
            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();

            $path = $file->storeAs('DataInvOutstansing', $namafile);
            $path = str_replace(public_path(), '', $path);

            // ImportFile::dispatch($path);
            // ImportOutstandingInvoice::dispatch($bulan, $tahun, $reminder_no, $path, public_path('storage/DataInvOutstansing/' . $namafile))->onQueue('whatsappBlast');
            Excel::import(new InvoiceOutstandingImport($bulan, $tahun, $reminder_no, $path/* public_path('storage/DataInvOutstansing/' . $namafile)*/), public_path('storage/DataInvOutstansing/' . $namafile));
            return response()->json(['success' => 'File ' . $namafile . ' has been uploaded and data imported successfully.']);
            //  bulan: ' . $bulan . ' tahun: ' . $tahun . ' reminder: ' . $reminder_no . 'path simpan:' . $path . ' file: ' . public_path('storage/DataInvOutstansing/' . $namafile)]);
        }
    }
}
