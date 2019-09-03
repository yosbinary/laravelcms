<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id',
        'author',
        'is_active',
        'email',
        'body'

    ]
    public function posts(){
        retun $this->hasMany('App\Post');
    }
}
