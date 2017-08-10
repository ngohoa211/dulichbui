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
    	return view('user_page.profile')->with('profile',$profile);
    }
     // public function getEditProfile(){
     //     $edit_pro=Auth::user()->id;
     //     return view('user_page.profile')->with('edit_pro',$edit_pro);
     // }
    public function postEditProfile(Request $request){
        $edit_pro=Auth::user();
        $edit_pro->name=$request->name;
        $edit_pro->email=$request->email;
        $edit_pro->password=bcrypt($request->newpass);
        $edit_pro->age=$request->age;
        $edit_pro->gender=$request->gender;
        $edit_pro->address=$request->address;
        $edit_pro->save();
        return redirect()->route('profile');

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
