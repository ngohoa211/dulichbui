<?php

namespace App\Http\Middleware;

use Closure;
use App\Comment;
class CheckExistCommentFather
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
        if(Comment::find($request->father_id)==null)
            return redirect('home');
        else
            return $next($request);
    }
}
