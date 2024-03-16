<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenanController extends Controller
{
    function index()
    {
        return view('Tenan.index', [
            'username' => Auth::user()->name,
            'title' => 'Welcome Tenan Relation'
        ]);
    }
}
