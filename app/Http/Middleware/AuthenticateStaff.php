<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class AuthenticateStaff
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
        if(!Auth::guard('staff')->check()){
            return redirect('/staff/login');
        }
        return $next($request);
    }
}
