<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class facility extends Model
{
    //
     protected $table = 'tbl_facility';
     public function getAvailablerooms($start_date, $end_date)
    {
    	$available_rooms = DB::table('tbl_facility as r')
    	                            ->select('r.id', 'r.facility_name', 'r.amount')
    	                            ->whereRaw("
                                    r.id NOT IN(
                                        SELECT b.facility_id FROM tbl_facility_booking_public b
                                        WHERE NOT(
                                            b.end_date < '{$start_date}' OR 
                                            b.starting_date > '{$end_date}' OR r.booking_type = 'multi'
                                        )
                                    )
    	                            ")
    	                            ->orderBy('r.id')
    	                            ->get()
    	;
    	return $available_rooms;
    }
     public function facility_booking_public(){
        return $this->hasMany('App\facility_booking_public', 'facility_id');
    }
     
}
