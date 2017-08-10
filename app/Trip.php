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
        return $this->hasOne('App\Picture')->where('comment_id',null);
    }
    //quan he voi comment
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function parts()
    {
        return $this->hasMany('App\Part');
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

    public function scopeListTripByCollectionID($query,$collectIDs)
    {
        $trips =  array();

        foreach ($collectIDs as $collectID) {
            # tim phan tu trip va add vao
            $trip= Trip::find($collectID->trip_id);
            array_push($trips,$trip);

        }
        if (empty($trips)) {
        // list is empty.
            return 'list is empty';
        }
        return  $trips;
    }
    
}
