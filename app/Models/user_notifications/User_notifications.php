<?php

namespace App\Models\user_notifications;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class User_notifications extends Model
{
    use SoftDeletes;
    protected $table="user_notification";
}
