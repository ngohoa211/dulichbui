<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Trip;
class User extends Authenticatable
{
    use Notifiable;
     protected $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $fillable = [
        'name', 'email', 'password','age','gender','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps=false;
    //quan he
    public function followTrips()
    {
        return $this->hasMany('App\FollowerTrip');
    }

    public function joinTrips()
    {
        return $this->hasMany('App\JoinerTrip');
    }

    public function ownerTrips()
    {

        return $this->hasMany('App\OwnerTrip');
    }

    public function avatar()
    {
        return $this->hasOne('App\Picture');
    }
    //////////////////
    public function comments()
    {

        return $this->hasMany('App\Comment');
    }
    public function scopeListJoinTrips()
    {
        $join_trips= Trip::listTripByCollectionID($this->joinTrips);
        return $join_trips ;
    }

    public function scopeListOwnTrips()
    {
        $own_trips= Trip::listTripByCollectionID($this->ownerTrips);
        return $own_trips;
    }

    public function scopeListFollowTrips()
    {
        $follow_trips= Trip::listTripByCollectionID($this->followTrips);
        return $follow_trips;
    }
}
