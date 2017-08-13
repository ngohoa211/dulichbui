<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;
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
        $this->validate($request,[
               'name' => 'required|string|max:255',
                'newpass' => 'required|string|min:1',
                'confirm_newpass' => 'required|same:newpass',
          ],[
                // 'name.required' => ' Không được bỏ trống tên của bạn',
                // 'email.required' => ' Không được bỏ trống thời gian dự kiến bắt đầu ',
                // 'password.required' =>'Không được bỏ trống password mới',
                // 'email.unique' => ' email bị trùng '
          ]);    
        if(Hash::check($request->input('password'), Auth::user()->password)==false){
            return redirect()->back()->withInput()->withErrors(['pass' => 'wrong old password']);
        }
        
        $edit_pro=Auth::user();
        $edit_pro->name=$request->name;
        $edit_pro->email=Auth::user()->email;
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
