<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    protected $fillable = [
        'post_id','content', 'media' , 'created_at','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('User');
    }


}
