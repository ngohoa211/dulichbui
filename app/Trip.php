<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $query->join('pictures', 'trips.id', '=', 'pictures.trip_id')
        ->where('pictures.comment_id',null)
        ->select('trips.id','name','url')
        ->orderBy('trips.created_at', 'DESC')
        ->paginate(4,['*'], 'new_trips');
    }

    public function scopeGetAllTripHot($query)
    {
        // $query_count_comment = DB::table('comments')
        //         ->select('trip_id', DB::raw('count(*) as num'))
        //          ->groupBy('trip_id');
        return $query->leftJoin('pictures', 'trips.id', '=', 'pictures.trip_id')
        ->leftJoin('comments','trips.id', '=','comments.trip_id')
        ->where('pictures.comment_id',null)
        ->select('trips.id','name','url',DB::raw('count(*) as num'))
        ->groupBy('trips.id','name','url')
        ->orderBy('num', 'DESC')
        ->paginate(4,['*'], 'hot_trips');
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
