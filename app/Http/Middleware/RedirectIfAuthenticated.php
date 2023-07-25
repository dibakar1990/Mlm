<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $guard = null)
    {
       //dd(Auth::user());
        if (Auth::guard($guard)->check()) {
            if (auth::user()->hasRole('admin')) {
                
                if (Auth::user()->type == 1) {
                    
                    return redirect('/admin/dashboard');
                }
            }else if(auth::user()->hasRole('user')){
                
                if (Auth::user()->type == 2) {
                   
                    return redirect('/user/dashboard');
                }
            } 
        }

        return $next($request);
    }
}
