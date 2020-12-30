<?php

namespace App\Models\comment_likes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment_like extends Model
{
    use SoftDeletes;
    protected $table="comments_like";

    public function user()
    {
        return $this->hasOne('App\User','id','video_like_id');
    }
    
    public function video()
    {
        
    
        return $this->hasOne('App\Models\video\Video','user_id','comment_id');
    }
}
