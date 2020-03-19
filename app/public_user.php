<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class public_user extends Model
{
    //
    protected $table = "tbl_public_users";
    public function facility_booking_public(){
        return $this->hasMany('App\facility_booking_public', 'public_user_id');
    }
    
}
