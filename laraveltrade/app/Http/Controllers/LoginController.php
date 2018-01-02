<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login()
    {
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required',
            'is_remember' => 'integer'
        ]);
        $email = request('email');
        $password = request('password');
        $is_remember = boolval(request('is_remember'));
        if (\Auth::attempt(compact('email','password'),$is_remember))
        {
            return redirect('/posts');
        }

        return back();
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }

}
