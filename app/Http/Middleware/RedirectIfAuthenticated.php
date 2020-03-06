<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->role_id==11) {
            return redirect('admin/index');
        }else if(Auth::guard($guard)->check() && Auth::user()->role_id==1){
              return redirect('customer/index');
        }
        else if(Auth::guard($guard)->check() && Auth::user()->role_id==2){
              return redirect('customer/shop');
        }else{
           
           return \redirect('/signin')->with('error','Please Verify first!!!'); 
        }
 return $next($request);
        
    }
}
