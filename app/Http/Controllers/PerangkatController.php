<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PerangkatController extends Controller
{
    function index()
    {
        return view('Perangkat.index', [
            'username' => Auth::user()->name,
            'title' => 'Data Device Whastapp Blast',
            'javascript' => 'Perangkat.script'
            // 'data' => Ownership::all()
        ]);
    }
    function json(Request $request)
    {
        $data = DB::table('roles')
            ->select(['id', 'level', 'no_wa', 'api_key', 'api_key_number', 'api_endpoin_url'])
            ->whereNotIn('id', ['1'])
            ->get();

        // Mengembalikan data menggunakan DataTables
        return DataTables::of($data)->make(true);
    }
    function getdetail(Request $request)
    {
        // dd($request->all());

        $id = $request->id;
        $data = DB::table('roles')
            ->select(['id', 'level', 'no_wa', 'api_key', 'api_key_number', 'api_endpoin_url'])
            ->where('id', $id)
            ->first();

        // dd(response()->json($data));
        return response()->json($data);
    }
    function update(Request $request)
    {
        // dd($request->all());
        $id = $request->id_perangkat;
        $request->validate([
            'owner' => 'required',
            'no_wa' => 'required',
            'api_key' => 'required',
            'api_key_number' => 'required',
            'endpoin' => 'required'
        ]);
        $upd = ([
            'level' => $request->owner,
            'no_wa' => $request->no_wa,
            'api_key' => $request->api_key,
            'api_key_number' => $request->api_key_number,
            'api_endpoin_url' => $request->endpoin,
            'updated_at' => now(),
        ]);

        $result = DB::table('roles')
            ->where('id', $id)
            ->update($upd);

        if ($result) {

            return response()->json([
                'remove' => 'alert-danger',
                'add' => 'alert-success',
                'message' => 'Data updated successfully '
            ]);
        } else {
            return response()->json([
                'add' => 'alert-danger',
                'remove' => 'alert-success',
                'message' => 'Failed to update data '
            ]);
        }
    }
}
