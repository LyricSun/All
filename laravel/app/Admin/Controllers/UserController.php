<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/14
 * Time: 上午10:22
 */
namespace App\Admin\Controllers;

use App\AdminRole;
use App\AdminUser;

class UserController extends Controller{
    public function index()
    {
        $users = AdminUser::orderBy('created_at','desc')->get();
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store()
    {
        $this->validate(request(),[
            'name' => 'required|min:3',
            'password' => 'required|min:5'
        ]);
        AdminUser::create(['name'=>request('name'),'password'=>bcrypt(request('password'))]);
        return redirect('/admin/users');
    }

    public function role(AdminUser $user)
    {
        $roles = \App\AdminRole::all();
        $myRoles = $user->roles;
        return view('admin.user.role',compact('user','roles','myRoles'));
    }

    public function storeRole(AdminUser $user)
    {
        $this->validate(request(),[
            'roles' => 'required|array'
        ]);
        $myRoles = $user->roles;
        $newRoles = AdminRole::findMany(request('roles'));
        $addRoles = $newRoles->diff($myRoles);
        foreach ($addRoles as $role)
        {
            $user->assignRole($role);
        }
        $deleteRoles = $myRoles->diff($newRoles);
        foreach ($deleteRoles as $role)
        {
            $user->deleteRole($role);
        }
        return back();
    }

}