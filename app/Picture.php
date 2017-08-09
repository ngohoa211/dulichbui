<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
     protected $table='pictures';

     public function comments(){
     	//return $this->belongsTo('App\Comment','comment_id','id');
     	return $this->belongsTo('App\Comment');
     }
}
