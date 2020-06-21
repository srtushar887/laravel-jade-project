<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ManagerCheck
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
        if (Auth::check()){
            if (Auth()->user()->account_type == 2){
                return $next($request);
            }else{
                return redirect(route('user.verify'))->with('alert','Sorry! Account Not Active');
            }
        }
    }
}
