<?php

namespace App\Models\video_likes;

use Illuminate\Database\Eloquent\Model;

class Video_likes extends Model
{
    protected $table="video_likes";
    use SoftDeletes;
}
