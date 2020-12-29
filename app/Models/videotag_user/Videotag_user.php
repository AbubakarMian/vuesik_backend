<?php

namespace App\Models\videotag_user;

use Illuminate\Database\Eloquent\Model;

class Videotag_user extends Model
{
    use SoftDeletes;
    protected $table="videotag_user";
}
