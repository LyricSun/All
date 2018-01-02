<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/14
 * Time: 上午10:22
 */
namespace App\Admin\Controllers;

use App\AdminRole;

class RoleController extends Controller{
    public function index()
    {
        $roles = AdminRole::all();
        return view('admin.role.index',compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store()
    {
        $this->validate(request(),[
            'name' => 'required|min:3',
            'description' => 'required|max:100'
        ]);
        AdminRole::create([
            'name' => request('name'),
            'description' => request('description')
        ]);
        return redirect('/admin/roles');
    }

    public function permission(AdminRole $role)
    {
        $permissions = \App\AdminPermission::all();
        $myPermissions = $role->permissions;
        return view('admin.role.permission',compact('role','permissions','myPermissions'));
    }

    public function storePermission(AdminRole $role)
    {
        $this->validate(request(),[
            'permissions' => 'required|array'
        ]);
        $permissions = $role->permissions;
        $newPermissions = \App\AdminPermission::findMany(request('permissions'));

        $addPermissions = $newPermissions->diff($permissions);
        foreach ($addPermissions as $permission)
        {
            $role->grantPermission($permission);
        }
        $deletePermissions = $permissions->diff($newPermissions);
        foreach ($deletePermissions as $permission)
        {
            $role->deletePermission($permission);
        }
        return back();
    }
}