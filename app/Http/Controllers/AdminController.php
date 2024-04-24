<?php

namespace App\Http\Controllers;

use App\Models\Outbox;
use Illuminate\Http\Request;
use App\Imports\OwnershipImport;
//use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    function index()
    {
        return view('Admin.index', [
            'username' => Auth::user()->name,
            'title' => 'Admin'
        ]);
    }
    function administrator()
    {
        return view('Admin.index', [
            'username' => Auth::user()->name,
            'title' => 'Welcome Administrator'
        ]);
    }
    function billing()
    {
        // dd(Auth::user());
        return view('Billing.index', [
            'username' => Auth::user()->name,
            'title' => 'Welcome Billing'
        ]);
    }
    function collection()
    {
        return view('Collection.index', [
            'username' => Auth::user()->name,
            'title' => 'Welcome Operator'
        ]);
    }
    function rere1()
    {
        return view('Rere.index', [
            'username' => Auth::user()->name,
            'title' => 'Welcome Operator'
        ]);
    }
    function rere2()
    {
        return view('Tenan.index', [
            'username' => Auth::user()->name,
            'title' => 'Welcome Operator'
        ]);
    }

    // function ownershipimport()
    // {
    //     return view('Admin.importownership', [
    //         'username' => Auth::user()->name,
    //         'title' => 'Import Data Ownership'
    //     ]);
    // }
    // function import_proses_ownership(Request $request)
    // {
    //     try {

    //         Excel::import(new OwnershipImport(), $request->file('file'));
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
    function dashboard()
    {
    }
    function antrian_outbox()
    {

        $data_antrian = DB::table('outboxs')
            ->leftJoin('ownerships', 'outboxs.debtor_acct', '=', 'ownerships.business_id')
            ->select(['fin_month', 'fin_year', 'debtor_acct', 'name', 'tglkirim', 'wa', 'pesan', 'tipe', 'status', 'job'])
            ->whereNull('tglsending')
            ->wherenotNull('job')
            ->count();
        $job = DB::table('jobs')->count();
        // dd($data, $job);
        if ($data_antrian > 0 && $job == 0) {

            // $update_kolom_job = "Lakukan";
            $upd = DB::table('outboxs')
                ->whereNull('tglsending')
                ->wherenotNull('job')
                ->update(['job' => null]);
        }
        // else {
        //     $update_kolom_job = "lewati";
        //     // $upd = 0;
        // }
        // dd($update_kolom_job, $upd);

        return view('Admin.outbox', [
            'username' => Auth::user()->name,
            'title' => 'Data Outbox',
            'javascript' => 'Admin.scriptoutbox',
        ]);
    }
    function json_outbox_antrian()
    {
        $data = DB::table('jobs')->count();
        // dd($data);
        $total = $data;
        // $this->yourModel->getTotalOutboxCount(); // Panggil metode yang menghitung total jumlah baris
        return response()->json(['total' => $total]);
    }
    function json_outbox(Request $request)
    {

        // dd($request->antrian);

        if ($request->antrian == 'yes') {
            $data = DB::table('outboxs')
                ->leftJoin('ownerships', 'outboxs.debtor_acct', '=', 'ownerships.business_id')
                ->select([
                    'fin_month',
                    'fin_year',
                    'debtor_acct',
                    'name',
                    'tglkirim',
                    'wa',
                    DB::raw('LEFT(pesan, 100) as pesan'), // Mengambil 100 karakter pertama dari kolom 'pesan'
                    'tipe',
                    'status',
                    'job'
                ])
                ->whereNull('tglsending')
                ->wherenotNull('job')
                ->get();
        } else {

            $data = DB::table('outboxs')
                ->leftJoin('ownerships', 'outboxs.debtor_acct', '=', 'ownerships.business_id')
                ->select([
                    'fin_month',
                    'fin_year',
                    'debtor_acct',
                    'name',
                    'tglkirim',
                    'wa',
                    DB::raw('LEFT(pesan, 100) as pesan'), // Mengambil 100 karakter pertama dari kolom 'pesan'
                    'tipe',
                    'status',
                    'job'
                ])
                ->whereNull('tglsending')
                ->whereNull('job')
                ->get();
        }

        return DataTables::of($data)->make(true);
    }
}
