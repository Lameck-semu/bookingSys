<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bedspace extends Model
{
    //

    protected $fillable = [
        'hall_name','space','gender_for','room_from','room_to','programme_id','year','occupants_per_room','occupied_by',
    ];
     protected $table = 'tbl_bed_space';
     public function rooms(){
        return $this->hasMany('App\rooms', 'hall_id');
    }
    public function facility_booking_student(){
        return $this->hasMany('App\facility_booking_student', 'bed_space_id');
    }
    public function programmes(){
        return $this->belongsTo('App\programmes', 'programme_id');
    }
}
