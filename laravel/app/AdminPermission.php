<?php

namespace App;


class AdminPermission extends Model
{
    public function roles()
    {
        return $this->belongsToMany('\App\AdminRole','admin_permission_role','permission_id','role_id')->withPivot(['role_id','permission_id']);
    }
}
