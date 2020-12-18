<?php

namespace App\Models\audio;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $table="audios";

    function audio_owner()
    {
        # code...
        return $this->hasOne('App\User','id','user_id')->select('id','name');
    }

    
}
