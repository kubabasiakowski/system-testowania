<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class TeacherMiddleware
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
        $status = Auth::user()->status;
        if(Auth::check() && $status=='prowadzacy')
            return $next($request);
        else
            return redirect('/home');
    }
}
