<?php

namespace App\Models\hashtag;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use SoftDeletes;
    protected $table="hashtags";
    function videohtag(){
        return $this->hasMany('App\Models\video\Video','id','video_id');
    }

    // function soundtag(){
    //     return $this->hasMany('App\Models\audio\Audio','id','');
    // }

    function userstag(){
        return $this->hasMany('App\Models\video\Video','id','video_id');
    }
}
