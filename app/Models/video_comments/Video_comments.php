<?php

namespace App\Models\video_comments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video_comments extends Model
{
    protected $table="videos_comments";
    use SoftDeletes;
    
}
