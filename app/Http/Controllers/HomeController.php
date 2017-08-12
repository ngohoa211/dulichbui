<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
         $hot_trips=Trip::getAllTripHot();
         return view('home')
         ->with('new_trips',$new_trips)
         ->with('hot_trips',$hot_trips); 

    }
}
