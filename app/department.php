<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    //
    protected $table = 'tbl_department';
    public function programmes(){
     	return $this->hasMany('App\programmes', 'department_id');
     }
     
}
