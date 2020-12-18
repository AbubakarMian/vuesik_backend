<?php

namespace App\Models\user_followed;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_followed extends Model
{
    use SoftDeletes;
    protected $table="user_followed";

    function followed()
    {
        # code...
 
        return $this->hasMany('App\User','id','user_id');
    }

    function myfollowers()
    {
        # code...
 
        return $this->hasMany('App\User','id','followed_id');
    }
}
