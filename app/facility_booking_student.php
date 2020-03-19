<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class facility_booking_student extends Model
{
    //
     protected $table = 'tbl_facility_booking_student';

     public function User(){
     	return $this->belongsTo('App\User', 'users_id');
     }
     public function bedspace(){
     	return $this->belongsTo('App\bedspace', 'bed_space_id');
     }
     public function programmes(){
     	return $this->belongsTo('App\programmes', 'programme_id');
     }
}
