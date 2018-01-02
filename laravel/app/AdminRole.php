<?php

namespace App;


class AdminRole extends Model
{
    public function permissions()
    {
        return $this->belongsToMany('App\AdminPermission','admin_permission_role','role_id','permission_id')->withPivot(['role_id','permission_id']);
    }

    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    public function hasPermission($permission)
    {
        return $this->permissons->contains($permission);
    }
}
