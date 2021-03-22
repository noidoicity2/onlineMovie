<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class AuthController extends Controller
{
    //
    public function PostLogin(Request $request) {
//        if(Auth::user()) return "logged in";
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }else abort(401);


    }

    public function Login() {
        if(Auth::user()) return "logged in";
        return view('login');
    }
    public function Logout() {
        Auth::logout();

        return redirect()->route('login');

    }
}
