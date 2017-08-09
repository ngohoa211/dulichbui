<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Trip;
use App\Part;
use App\OwnerTrip;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function showFormCreateTrip(Request $request){
      return view('trips.trips_create');
    }
    public function CreateTrip(Request $request){
    	//create trip then add part
    	//lay ten cac block
        $this->validate($request,[
               'name' => 'required|unique:trips',
               'start_date' => 'required',
               'end_date' => 'required',

               // 'end_bet_time' => 'before:start_time',
          ],[
                'name.required' => ' Không được bỏ trống tên chuyến đi',
                'start_date.required' => ' Không được bỏ trống thời gian dự kiến bắt đầu ',
                'end_date.required' => ' Không được bỏ trống thời gian dự kiến kết thúc '
          ]);
    	$array_input=Input::all();
    	$blocks=explode(" ",$array_input['nameblocks']);
		//////////////////
      $trip = new Trip;
      $trip->name=$array_input['name'];
      $trip->start_date=$array_input['start_date'];
      $trip->end_date=$array_input['end_date'];
      $trip->place_gather=$array_input['place_gather'];
      $trip->save();
      $imageInput::file('cover');
      $owner_this_trip = new OwnerTrip;
      $owner_this_trip->user_id = Auth::id();
      $owner_this_trip->trip_id = $trip->id;
      $owner_this_trip->save();
      $status_part = 1;
    	foreach ($blocks as $block) {
    		# 
            $part = new Part;
    		    $searchword = $block;
            $matches = array_filter(
                            $array_input,
                             function($key) use ($searchword) { return preg_match("/$searchword/", $key); },
                              ARRAY_FILTER_USE_KEY
                              );
            
            $part ->status = $status_part;
            $part ->name = $matches[$block.'vitri'];
            $part ->start_latitude = $matches[$block.'latitude'];
            $part ->start_longitude = $matches[$block.'longtitude'];
            $part ->end_latitude = $matches[$block.'latitude'];
            $part ->end_longitude = $matches[$block.'longtitude']; 
            $part ->start_date = $matches[$block.'start_date'];
            $part ->end_date = $matches[$block.'end_date'];
            $part ->move_by = $matches[$block.'moveby'];
                            
            $part->trip_id=$trip->id;
            if(array_key_exists ($block.'activiti', $matches )==false){
                $part->activiti = null;
            }else $part->activiti = $matches[$block.'activiti'];
            $part->save();
            $status_part++;
    	}
      return redirect('/trip_home/plan/'.$trip->id);
    }
}