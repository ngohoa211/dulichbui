<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    protected $table='trips';
    public function scopeFindTripOrderByCreatAt($query)
    {
    	return $query->orderBy('created_at', 'DESC')->simplePaginate(4);
    }

    //quan he voi imagine
    public function coverimg()
    {
        return $this->hasOne('App\Picture');
    }

}
