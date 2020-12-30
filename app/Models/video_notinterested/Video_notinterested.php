<?php

namespace App\Models\video_notinterested;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Video_notinterested extends Model
{
    use SoftDeletes;
    protected $table="video_notinterested";
}
