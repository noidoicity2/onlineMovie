<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class AuthController extends Controller

{
    protected $userRepository;
    //
    public function __construct(UserRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function PostLogin(Request $request) {
//        if(Auth::user()) return "logged in";
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->role_id == 1) return redirect(route('add_movie'));
            return redirect(route('home_customer'));
        }else return back()->withErrors([ 'Invalid email or password']);


    }
    public function PostRegister(Request $request) {
        $user = $request->all();
       $user['password'] = bcrypt($user['password']);

       $this->userRepository->create( array_merge($user , ['role_id' => 1]) );
       return back()->with(['message'=> "Register successfully"]);

    }
    public function  Register() {
        return view('register');
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
