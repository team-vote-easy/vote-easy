<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

class AuthenticateStudents
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
        if(! Auth::guard('students')->check() ){
            return redirect('/student-login');
        }

        return $next($request);
    }
}
