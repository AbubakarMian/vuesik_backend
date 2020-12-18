<?php

namespace App;

use App\Models\user_followed\User_followed;
use App\Models\video\Video;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     
    public static $rules = [
        // 'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ];

    // function uservideos()
    // {
    //     return $this->hasMany('App\video\Video');
    // }
    
    function user_followed()
    {
        
        return $this->hasMany('App\user_followed\user_followed','followed_id','id');
    }

    function uservideos()
    {

        # code...
        return $this->hasMany('App\Models\video\Video','user_id','id');
        // return $this->hasMany('followed_id')->where('user_id','id')->count();
        // return $this->hasMany('App\Models\video\Video','id','user_id');
    }
}
