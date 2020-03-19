<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','gender', 'email', 'password', 'last_name', 'middlename', 'role_id', 'programmes_id','reg_number',
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

    public function facility_booking_student(){
        return $this->hasMany('App\facility_booking_student', 'users_id');
    }
 public function facility_booking_public(){
        return $this->hasMany('App\facility_booking_public', 'user_id');
    }
    public function next_of_kin(){
        return $this->hasOne('App\next_of_kin', 'user_id');
    }

    public function programmes(){
        return $this->belongsTo('App\programmes', 'programmes_id');
    }
}
