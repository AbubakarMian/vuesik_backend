<?php

namespace App\Models\audio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Audio extends Model
{
    use SoftDeletes;
    protected $table="audios";

    function audio_owner()
    {
        # code...
        return $this->hasOne('App\User','id','user_id')->select('id','name');
    }

    
}
