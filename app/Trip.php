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

    public function scopeGetAllTrip($query)
    {
        return $query->get();
    }

    public function scopeGetAllTripNew($query)
    {
        return $query->paginate(4,['*'], 'new_trips');
    }

    public function scopeGetAllTripHot($query)
    {
        return $query->paginate(4,['*'], 'hot_trips');
    }

}
