<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $url = \Request::segment(1);
        if(\Request::segment(2)){
            $url .= '/'.\Request::segment(2);
        }

        $user_type = Auth::guard($guard)->user()->user_type;
        if(!canAccess($user_type, $url)){
            return redirect()->back();
        }
        return $next($request);
    }
}
