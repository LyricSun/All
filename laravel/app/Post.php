<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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

    public function zans()
    {
        return $this->hasMany('App\Zan');
    }

    public function zan($user_id)
    {
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }

    public function scopeAuthorBy(Builder $query,$user_id)
    {
        return $query->where('user_id',$user_id);
    }

    public function postTopics()
    {
        return $this->hasMany('App\PostTopic','post_id','id');
    }

    public function scopeTopicNotBy(Builder $query,$topic_id)
    {
        return $query->doesnthave('postTopics','and',function ($q)use ($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }
}
