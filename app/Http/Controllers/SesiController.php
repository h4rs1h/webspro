<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('layout/login');
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email Wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role_id == '1') {
                return redirect('/admin');
            } elseif (Auth::user()->role_id == '2') {
                return redirect('/billing');
            } elseif (Auth::user()->role_id == '3') {
                return redirect('/collection');
            } elseif (Auth::user()->role_id == '4') {
                return redirect('/rere1');
            } elseif (Auth::user()->role_id == '5') {
                return redirect('/rere2');
            }
        } else {
            return redirect('')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
