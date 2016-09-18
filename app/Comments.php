<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'content', 'post_id','user_id'
    ];
    public function post()
    {
        return $this->hasOne('App\Posts');
    }
    public function replais(){
        return $this->hasMany(Comments::class , 'reply_comment_id');
    }
}

