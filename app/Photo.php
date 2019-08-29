<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    Protected $upload = '/images/';
    protected $fillable = ['file'];

    public function getFileAttribute($photo){
        return $this->upload.$photo;
    }
}
