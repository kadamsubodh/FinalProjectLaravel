<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class checkCustomerLogin
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
        if(Auth::user())
        {
            if(Auth::user()->role_id == 5)
            {
                return $next($request);
            }else
            {
                Auth::logout();
                return redirect('/eshopers/login');
            }
        }
        else{
            return $next($request);
        }
    }
}
