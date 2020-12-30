<?php

namespace App\Models\video_mention;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Video_mention extends Model
{
    use SoftDeletes;
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
