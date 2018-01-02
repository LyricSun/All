<?php

namespace App;

use Laravel\Scout\Searchable;


class Post extends Model
{
    use Searchable;


    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content
        ];
    }
    public function searchableAs()
    {
        return 'post';
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
