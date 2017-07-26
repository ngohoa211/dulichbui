<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    protected $table='trips';
    

    //quan he voi imagine
    public function coverimg()
    {
        return $this->hasOne('App\Picture');
    }
    //quan he voi comment
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function scopeGetTripsOrderByCreatAt($query)
    {
        return $query->orderBy('created_at', 'DESC')->paginate(4);
    }

    public function scopeGetAllTrip($query)
    {
        return $query->paginate(4);
    }

}
