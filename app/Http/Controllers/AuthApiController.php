<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;

class AuthApiController extends Controller
{


    public function postlogin(Request $r)
    {

        $this->validate($r, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($r->only('username', 'password'))) {
            $respon = array(
                'success' => true,
                'message' => 'Login Berhasil',
            );
            $response = new Response(json_encode($respon));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } else {
            return new Response(['message' => 'login Failed'], 422);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
