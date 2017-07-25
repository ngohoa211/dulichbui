<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserpageController extends Controller
{
    //
    public function getInsert(){
    	$id=Auth::id();
    	$profile = User::find($id);
    	return view('user_page.profile',compact('profile'));
    }
}
