<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
     protected $table='pictures';

     public function comments(){
     	return $this->belongsTo('App\Comment','picture_id','id');
     }
}
