<?php

namespace App;

use App\Model;

class Fan extends Model
{
    public function fuser()
    {
        return $this->hasOne('App\User','id','fan_id');
    }

    public function suser()
    {
        return $this->hasOne('App\User','id','star_id');
    }
}
