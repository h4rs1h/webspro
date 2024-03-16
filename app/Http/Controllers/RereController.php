<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RereController extends Controller
{
    function index()
    {
        return view('Rere.index', [
            'username' => Auth::user()->name,
            'title' => 'Welcome Rere 1'
        ]);
    }
}
