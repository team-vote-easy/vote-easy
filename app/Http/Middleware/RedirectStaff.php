<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class RedirectStaff
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
        if(Auth::guard('staff')->check()){
            return redirect('/staff/home');
        }
        return $next($request);
    }
}
