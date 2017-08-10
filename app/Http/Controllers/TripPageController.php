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
			$user=User::find($user_need_join->user_id);
			
			
			if($user_need_join->agree==0){		
				$user->time_in = $user_need_join->updated_at;
				array_push($watingers,$user);
				
			}else if($user_need_join->agree==1){
				$user->time_request = $user_need_join->created_at;
				array_push($joiners,$user);
			}
		}
		$owner_id=OwnerTrip::where('trip_id',$trip_id)->pluck('user_id')->first();
		$owner=User::find($owner_id);
		$permission = $this->getPermission(Auth::id(), $trip_id);
		return View::make('trips.trip_member')
						->with('permission',$permission)
						->with('trip_id',$trip_id)
						->with('owner',$owner)
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

		return 'watch';
	}
	public function editPlan($trip_id){

	}
	public function addFollow($trip_id,$user_id)
	{

		$folow= new FollowerTrip;
		$folow->trip_id=$trip_id;
		$folow->user_id=$user_id;
		$folow->save();
		return redirect()->route('list_follow');
	}
	public function addRequestJoin($trip_id)
	{
		$join= new JoinerTrip;
		$join->trip_id=$trip_id;
		$join->user_id=Auth::id();
		$join->agree=0;
		$join->save();
		return redirect()->route('show_trip_plan',$trip_id);
	}

	public function deleteFollow($trip_id,$user_id)
	{
		FollowerTrip::where('trip_id',$trip_id)->where('user_id',$user_id)->delete();
		return redirect()->route('show_trip_plan',$trip_id);
	}

	public function deleteRequestJoin($trip_id)
	{
		JoinerTrip::where('trip_id',$trip_id)->where('user_id',Auth::id())->where('agree',0)->delete();
		return redirect()->route('show_trip_plan',$trip_id);
	}
	public function quitTrip($trip_id)
	{
		JoinerTrip::where('trip_id',$trip_id)->where('user_id',Auth::id())->where('agree',1)->delete();
		return redirect()->route('show_trip_plan',$trip_id);
	}

}