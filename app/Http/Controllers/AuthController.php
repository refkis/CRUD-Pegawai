<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $r)
    {

        $this->validate($r, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($r->only('username', 'password'))) {
            return redirect('/pegawai')->with('info', 'Welcome back !!!');
        } else {
            return redirect('/login')->with('error', 'username atau password ada yang salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
