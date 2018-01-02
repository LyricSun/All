<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/14
 * Time: 上午10:22
 */
namespace App\Admin\Controllers;

class LoginController extends Controller{
    public function index()
    {
        return view('admin.login.index');
    }

    public function login()
    {
        $this->validate(request(),[
            'name' => 'required',
            'password' => 'required'
        ]);
        $adminData = request(['name','password']);
        if (\Auth::guard('admin')->attempt($adminData))
        {
            return redirect('/admin/home');
        }
        return back()->withErrors('用户名或密码错误');
    }

    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}