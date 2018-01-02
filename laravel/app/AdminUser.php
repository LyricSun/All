<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authentication;

class AdminUser extends Authentication
{
    protected $rememberTokenName = '';
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany('App\AdminRole','admin_role_user','user_id','role_id')->withPivot(['user_id','role_id']);
    }

    public function isInRoles($roles)
    {
        return !!$this->roles->intersect($roles)->count();
    }

    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }

    public function hasPermission($permission)
    {
        return $this->isInRoles($permission->roles);
    }
}
