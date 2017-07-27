<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;

class AllTripController extends Controller
{
    //
    public function listAllTrip(){
    	$trips=Trip::getAllTrip();
    	foreach ($trips as $trip) {
             # them anh 
            $trip->coverimg = Trip::find($trip->id)->coverimg->url;
         }

    	return view('all trip.alltrip',compact('trips'));
    }
}