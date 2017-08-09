<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Trip;
use App\Part;
use App\User;
use App\JoinerTrip;
use App\FollowerTrip;
use App\OwnerTrip;
use Illuminate\Support\Facades\Auth;
use View;





class TripPageController extends Controller
{
	public function showPage($trip_id){
		$permission = $this->getPermission(Auth::id(), $trip_id);
		return view('trips.trips_detail',['permission'=>$permission],['trip_id'=>$trip_id]);
	}
	public function show_member($trip_id){

		
		$joiners = array();
		$watingers = array();
		$user_need_joins = JoinerTrip::where('trip_id', $trip_id)->get();

		foreach ($user_need_joins as $user_need_join) {
			# 
			$user=User::find($user_need_join->user_id)->first();
			
			$user->time_in = $user_need_join->created_at;
			
			if($user_need_join->agree==0){		
				array_push($watingers,$user);
				
			}else{
				array_push($joiners,$user);
				dd($user);
			}
		}
		
		$permission = $this->getPermission(Auth::id(), $trip_id);
		return View::make('trips.trip_member')
						->with('permission',$permission)
						->with('trip_id',$trip_id)
						->with('joiners',$joiners)
						->with('watingers',$watingers);
	}
	public function getPermission($user_id, $trip_id)
	{
		//moi user chi co duy nhat 1 vai tro! : owner, wating, joined, folow, watch && guess chi co duy nhat la watch
		if(Auth::guest())
			return 'watch';

		$status = OwnerTrip::where('user_id',$user_id)->where('trip_id', $trip_id)->first();
		if($status != null)
			return 'owner';

		$status = JoinerTrip::where('user_id',$user_id)->where('trip_id', $trip_id)->first(); 
		if($status != null){
			if($status->agree==0 ) return 'waitting';
			else return 'joined';
		}
		//sap xep return the nay se khien cho muon bo fowlow thi phai out khoi nhom truoc. 
		$status = FollowerTrip::where('user_id',$user_id)->where('trip_id', $trip_id)->first(); 
		if($status != null) return 'folowed';

	}
	public function editPlan($trip_id){

	}

}