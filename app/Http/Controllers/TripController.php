<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Trip;
use App\Part;
use App\User;
use App\Picture;
use App\JoinerTrip;
use App\OwnerTrip;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{

    public function showFormCreateTrip(Request $request){
      return view('trips.trips_create');
    }
    //xử lý post khi tạo 1 trip. lưu vào database
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
        if($request->file('cover')==null) return redirect()->back()->withInput()->withErrors(['needimg' => 'cover is requied']);

      $array_input=Input::all();
    	$blocks=explode(" ",$array_input['nameblocks']);
		//////////////////
      $trip = new Trip;
      $trip->name=$array_input['name'];
      $trip->start_date=$array_input['start_date'];
      $trip->end_date=$array_input['end_date'];
      $trip->place_gather=$array_input['place_gather'];
      $trip->save();

      $owner_this_trip = new OwnerTrip;
      $owner_this_trip->user_id = Auth::id();
      $owner_this_trip->trip_id = $trip->id;
      $owner_this_trip->save();

      $status_part = 0;
    	foreach ($blocks as $block) {
    		# 
            $part = new Part;
    		    $searchword = $block;
            $matches = array_filter(
                            $array_input,
                             function($key) use ($searchword) { return preg_match("/$searchword/", $key); },
                              ARRAY_FILTER_USE_KEY
                              );
            // if($matches['nameblocks']==null) continue;
            $part ->status = $status_part;
            $part ->name = $matches[$block.'vitri'];
            $part ->latitude = $matches[$block.'latitude'];
            $part ->longitude = $matches[$block.'longtitude'];
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
      $file = $request->file('cover');
      $image = new Picture();
      $image_name=Carbon::now()->format('YmdHs').$file->getClientOriginalName();
      $image->url='source/assets/dest/images/products/'.$image_name;
      $image->user_id=Auth::user()->id; 
      $image->trip_id=$trip->id;
      $file->move('source/assets/dest/images/products/',$image_name);
      $image->save();

      return redirect('/trip_home/plan/'.$trip->id);
    }
    //owner thêm member đã đăng kí join.
    public function addMember(Request $request,$trip_id,$user_id){
        $request_join=JoinerTrip::where('user_id',$user_id)->where('agree',0)->first();
        if($request_join!=null){
          $request_join->agree=1;
          $request_join->save();
        }
        return redirect()->route('show_member',$trip_id);
    }
    //owner xóa yêu cầu tham gia trip
    public function deleteRequest(Request $request,$trip_id,$user_id){
        JoinerTrip::where('user_id',$user_id)->where('agree',0)->delete();
        return redirect()->route('show_member',$trip_id);
    }
    //owner xóa 1 user khỏi danh sách mem của trip
    public function deleteJoiner(Request $request,$trip_id,$user_id){
        JoinerTrip::where('user_id',$user_id)->where('agree',1)->delete();
        return redirect()->route('show_member',$trip_id);
    }
    //hiện view edit cho người dùng nhập
    public function editPlan($trip_id){
          $trips=Trip::getTripAndCover($trip_id);
          return view('trips.trip_plan_edit')->with('trip',$trips);
    }
    //xử lý post của edit plan
    public function doEditPlan(Request $request,$trip_id){
         $this->validate($request,[
               'name' => 'required',
               'start_date' => 'required',
               'end_date' => 'required',

               // 'end_time' => 'before:start_time',
          ],[
                'name.required' => ' Không được bỏ trống tên chuyến đi',
                'start_date.required' => ' Không được bỏ trống thời gian dự kiến bắt đầu ',
                'end_date.required' => ' Không được bỏ trống thời gian dự kiến kết thúc '
          ]);

        $array_input=Input::all();
        $blocks=explode(" ",$array_input['nameblocks']);
        $trip=Trip::find($trip_id);
        $trip->name=$array_input['name'];
        $trip->start_date=$array_input['start_date'];
        $trip->end_date=$array_input['end_date'];
        $trip->place_gather=$array_input['place_gather'];
        $trip->save();
        //xoa het cac part cu
        foreach ($trip->parts as $pa) {
          $pa->delete();
        }
        //them part moi vao
        if(empty($array_input['nameblocks'])==false){
          $status_part = 0;
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
            $part ->latitude = $matches[$block.'latitude'];
            $part ->longitude = $matches[$block.'longtitude'];
            $part ->start_date = $matches[$block.'start_date'];
            $part ->end_date = $matches[$block.'end_date'];
            $part ->move_by = $matches[$block.'moveby'];
            $part->trip_id=$trip_id;
            if(array_key_exists ($block.'activiti', $matches )==false){
                $part->activiti = null;
            }else $part->activiti = $matches[$block.'activiti'];
            $part->save();
            $status_part++;
          }
        } 

        return redirect('/trip_home/plan/'.$trip->id);
    }
}