<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{
    //
    protected $table = 'tbl_rooms';
    public function bedspace(){
        return $this->belongsTo('App\bedspace', 'hall_id');
    }

}
