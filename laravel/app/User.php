<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authentication;

class User extends Authentication
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany('App\Post','user_id','id');
    }

    public function fans()
    {
        return $this->hasMany('App\Fan','star_id','id');
    }

    public function stars()
    {
        return $this->hasMany('App\Fan','fan_id','id');
    }

    public function doFan($user_id)
    {
        $fan = new \App\Fan();
        $fan->star_id = $user_id;
        return $this->stars()->save($fan);
    }

    public function doUnFan($user_id)
    {
        $fan = new \App\Fan();
        $fan->star_id = $user_id;
        return $this->stars()->delete($fan);
    }

    public function hasFan($user_id)
    {
        return $this->stars()->where('star_id',$user_id)->count();
    }

    public function hasStar($user_id)
    {
        return $this->fans()->where('fan_id',$user_id)->count();
    }

    public function notice()
    {
        return $this->belongsToMany('App\Notice','user_notice','user_id','notice_id');
    }

    public function addNotice(Notice $notice)
    {
        return $this->notices()->save($notice);
    }
}
