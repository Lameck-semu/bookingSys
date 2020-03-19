<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facility_booking_public extends Model
{
    //
     protected $table = 'tbl_facility_booking_public';
     public function user(){
     	return $this->belongsTo('App\user', 'user_id');
     }
      public function facility(){
     	return $this->belongsTo('App\facility', 'facility_id');
     }
}
