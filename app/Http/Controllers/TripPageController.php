<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Trip;
use App\Part;
use App\JoinerTrip;
use App\FollowerTrip;
use App\OwnerTrip;
use Illuminate\Support\Facades\Auth;

class TripPageController extends Controller
{
	public function showPage($trip_id){
		$user_id = Auth::id();
		$permission = $this->getPermission($user_id, $trip_id);
		return view('trips.trips_detail',['permission'=>$permission],['trip_id'=>$trip_id]);
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