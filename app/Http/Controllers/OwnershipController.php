<?php

namespace App\Http\Controllers;

use App\Imports\OwnershipImport;
use App\Models\Ownership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class OwnershipController extends Controller
{
    function index()
    {

        return view('ownership.index', [
            'username' => Auth::user()->name,
            'title' => 'Data Ownership',
            'javascript' => 'ownership.script',
            'data' => Ownership::all()
        ]);
    }
    function ownershipImport(Request $request)
    {
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        // $file->move('DataOwnership', $namafile);
        $file->storeAs('DataOwnership', $namafile);
        // Excel::import(new OwnershipImport(), public_path('/DataOwnership/' . $namafile));
        // return redirect('/ownership');
        Excel::import(new OwnershipImport(), public_path('storage/DataOwnership/' . $namafile));
        return response()->json(['message' => 'File ' . $namafile . ' has been uploaded and data imported successfully']);
    }
    function getData()
    {
        return view('ownership.getData', [
            'username' => Auth::user()->name,
            'title' => 'Data Ownership',
            // 'data' => Ownership::all()
        ]);
    }
    function json()
    {
        return DataTables::of(Ownership::limit(10))->make(true);
    }
}
