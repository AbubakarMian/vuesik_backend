<?php

namespace App\Models\massage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Massage extends Model
{
    use SoftDeletes;
    protected $table="messages";
}
