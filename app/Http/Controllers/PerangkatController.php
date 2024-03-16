<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerangkatController extends Controller
{
    function index()
    {
        return view('perangkat.index', [
            'username' => Auth::user()->name,
            'title' => 'Data Ownership',
            // 'data' => Ownership::all()
        ]);
    }
}
