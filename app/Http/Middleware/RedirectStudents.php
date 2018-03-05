<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class RedirectStudents
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
        if(Auth::guard('students')->check()){
            return redirect('/vote');
        }
        
        return $next($request);
    }
}
