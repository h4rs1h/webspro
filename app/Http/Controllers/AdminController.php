<?php

namespace App\Http\Controllers;

use App\Imports\OwnershipImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Excel;
use Maatwebsite\Excel\Facades\Excel;

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
}
