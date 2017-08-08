<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //
     protected $table='parts';

     public function trip(){
     	return $this->belongsTo('App\Trip','trip_id','id');
     }
}
