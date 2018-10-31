<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
class checkLogin
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
        if(!Auth::user() || Auth::user()->role_id=='5')
        {
            return redirect('/');
        }
        else
        {
             return $next($request);
        }
    }
}
