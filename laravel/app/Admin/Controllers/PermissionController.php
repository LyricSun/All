<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/14
 * Time: 上午10:22
 */
namespace App\Admin\Controllers;

use App\AdminPermission;

class PermissionController extends Controller{
    public function index()
    {
        $permissions = AdminPermission::all();
        return view('admin.permission.index',compact('permissions'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store()
    {
        $this->validate(request(),[
            'name' => 'required|min:3',
            'description' => 'required|max:100'
        ]);
        AdminPermission::create([
            'name' => request('name'),
            'description' => request('description')
        ]);
        return redirect('/admin/permissions');
    }
}