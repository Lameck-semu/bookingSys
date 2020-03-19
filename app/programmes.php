<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class programmes extends Model
{
    //
     protected $table = 'tbl_programmes';

     public function User(){
     	return $this->hasMany('App\User', 'programmes_id');
     }
     public function department(){
        return $this->belongsTo('App\department', 'department_id');
    }
    public function bedspace(){
        return $this->hasMany('App\bedspace', 'programme_id');
    }

    protected $fillable = [
        'programme_code','programme_name',
    ];
}
