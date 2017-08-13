<?php

namespace App\Http\Middleware;

use Closure;
use App\Trip;
class CheckExistTrip
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
        if(Trip::find($request->trip_id)==null) 
            return redirect('home');
        else
            return $next($request);
    }
}
