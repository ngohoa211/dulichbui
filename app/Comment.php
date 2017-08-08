<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
     protected $table='comments';

     public function user(){
     	return $this->belongsTo('App\User','user_id','id');
     }
      public function trips(){
     	return $this->belongsTo('App\Trip','trip_id','id');
     }
     public function pictures()
    {
        return $this->hasMany('App\Picture');
    }
}
