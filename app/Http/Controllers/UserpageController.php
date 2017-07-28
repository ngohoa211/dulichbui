<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserpageController extends Controller
{
    //
    public function getProfile(){
    	$profile = Auth::user();
    	return view('user_page.profile',compact('profile'));
    }

    public function listTripJoin(){
    	
    	$user = Auth::user();
    	$list=$user->listJoinTrips();
    	return view('user_page.listTrip')
    	->with('list',$list)
    	->with('name_page','List trip i join in');
    }

    public function listTripFolow(){
    	$user = Auth::user();
    	$list=$user->listFollowTrips();
    	return view('user_page.listTrip')
    	->with('list',$list)
    	->with('name_page','List trip i followed');
    }

    public function listTripCreate(){
    	$user = Auth::user();
    	$list=$user->listOwnTrips();
    	return view('user_page.listTrip')
    	->with('list',$list)
    	->with('name_page','List trip i created');
    }
    // $user_id=Auth::id();
}
