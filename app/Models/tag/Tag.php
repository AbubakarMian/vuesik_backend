<?php

namespace App\Models\tag;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use SoftDeletes;
    protected $table="tag";
    public function video()
    {
        return $this->hasMany('App\video\Video',
                            'id', 'video_id');
    }
}
