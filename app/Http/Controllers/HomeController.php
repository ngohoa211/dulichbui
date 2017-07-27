<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $new_trips=Trip::getAllTripNew();
         foreach ($new_trips as $new_trip) {
             # them anh 
            $new_trip->coverimg = Trip::find($new_trip->id)->coverimg->url;
         }
         # sap xep theo created_at
         $v_new_trips=$new_trips->sortByDesc('created_at');
         $v_new_trips->addlinks($new_trips->links());
         

         $hot_trips=Trip::getAllTripHot();
         foreach ($hot_trips as $hot_trip) {
             # them anh
            $hot_trip->coverimg = Trip::find($hot_trip->id)->coverimg->url;
         }

         foreach ($hot_trips as $hot_trip) {
             # them so luong comment
            $hot_trip->num_comment = Trip::find($hot_trip->id)->comments->count();
         }

            #sap xep theo luong comment
         $v_hot_trips=$hot_trips->sortByDesc('num_comment');
         $v_hot_trips->addlinks($hot_trips->links());

         return view('home')
         ->with('new_trips',$v_new_trips)
         ->with('hot_trips',$v_hot_trips); 

    }
}
