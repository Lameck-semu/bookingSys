<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reject extends Model
{
    //

    protected $table = "reject";

     protected $fillable = ['application_id','reason','rejected_by'];
}
