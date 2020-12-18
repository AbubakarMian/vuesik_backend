<?php

namespace App\Models\video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
    protected $table = "videos";

    public function comments()
    {
        return $this->hasMany('App\Models\video_comments\Video_comments', 'video_id', 'id');
    }

    public function video_owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
