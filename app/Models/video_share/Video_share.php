<?php

namespace App\Models\video_share;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Video_share extends Model
{
    use SoftDeletes;
    protected $table="video_share";
}
