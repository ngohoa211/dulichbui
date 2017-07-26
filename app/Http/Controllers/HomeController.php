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
         $new_trips=Trip::getTripsOrderByCreatAt();
         foreach ($new_trips as $new_trip) {
             # them anh 
            $new_trip->coverimg = Trip::find($new_trip->id)->coverimg->url;
         }

         $hot_trips=Trip::getAllTrip();
         foreach ($hot_trips as $hot_trip) {
             # them anh
            $hot_trip->coverimg = Trip::find($hot_trip->id)->coverimg->url;
         }
         foreach ($hot_trips as $hot_trip) {
             # them so luong comment
            $hot_trip->coverimg = Trip::find($hot_trip->id)->coverimg->url;
         }
         dd(Trip::find(1)->comments);
         #sap xep theo luong comment
         $hot_trips=$hot_trips->sortByDesc(function ($element) {
            return $element->data ? $element->data->num_comment : $element->num_comment;
        });
         dd($hot_trips->values()->all());

         
         return view('home')
         ->with('new_trips',$new_trips);
         // ->with('hot_trips',$hot_trips);
    }
}
