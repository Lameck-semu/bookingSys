<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class next_of_kin extends Model
{
    //
     protected $table = 'tbl_next_of_kin';
      public function User(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
