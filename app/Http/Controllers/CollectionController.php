<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    function index()
    {
        return view('Collection.index', [
            'username' => Auth::user()->name,
            'title' => 'Welcome Collection'
        ]);
    }
}
