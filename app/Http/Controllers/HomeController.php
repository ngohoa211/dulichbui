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
         $new_trips=Trip::findTripOrderByCreatAt();
         foreach ($new_trips as $new_trip) {
             # them anh "source/assets/dest/images/cac tinh mien trung.jpg"
            $new_trip->coverimg = Trip::find($new_trip->id)->coverimg->url;
         }
         
         return view('home')
         ->with('new_trips',$new_trips);
         // ->with('hot_trips',$hot_trips);
    }
}
