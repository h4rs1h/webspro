<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TemplatePesanController extends Controller
{
    function index()
    {
        return view('template.index', [
            'username' => Auth::user()->name,
            'title' => 'Template Pesan Whastapp Blast',
            'javascript' => 'template.script'

        ]);
    }
    function json(Request $request)
    {
        $data = DB::table('templatepesans')
            ->leftJoin('roles', 'roles.id', '=', 'templatepesans.role_id')
            ->select(['templatepesans.id', 'kode_pesan', 'judul_pesan', 'isi_pesan', 'role_id', 'roles.level'])
            ->whereNotIn('roles.id', ['1'])
            ->get();

        // Mengembalikan data menggunakan DataTables
        return DataTables::of($data)->make(true);
    }
}
