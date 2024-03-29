<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class StudentMiddleware
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
        if(Auth::check() && $status=='student')
            return $next($request);
        else
            return redirect('/home');
    }
}
