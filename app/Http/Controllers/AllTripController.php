<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;

class AllTripController extends Controller
{
    //hiện ra tất cả các trip
    public function listAllTrip(){
    	$trips=Trip::getAllTrip();
    	return view('all trip.alltrip')->with('trips',$trips);
    }
}