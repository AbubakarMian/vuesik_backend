<?php

namespace App\Models\user_notifications;

use Illuminate\Database\Eloquent\Model;

class User_notifications extends Model
{
    use SoftDeletes;
    protected $table="user_notification";
}
