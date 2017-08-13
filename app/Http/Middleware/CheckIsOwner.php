<?php

namespace App\Http\Middleware;

use Closure;
use App\Trip;
use App\OwnerTrip;
use Illuminate\Support\Facades\Auth;
class CheckIsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(OwnerTrip::where('trip_id',$request->trip_id)->where('user_id',Auth::id())->first()==null) 
            return redirect('home');
        else
            return $next($request);
    }
}
