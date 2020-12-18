<?php

namespace App\Models\video_mention;

use Illuminate\Database\Eloquent\Model;

class Video_mention extends Model
{
    protected $table="video_mention";

    public function mention_user()
    {
        return $this->hasMany('App\User', 'id', 'video_mention_id');
    }

    public function mention_video()
    {
        return $this->hasMany('App\Models\video\Video', 'id', 'video_id');
    }
}
