<?php

namespace App\Models\massage;

use Illuminate\Database\Eloquent\Model;

class Massage extends Model
{
    use SoftDeletes;
    protected $table="messages";
}
