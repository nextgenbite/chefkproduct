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
        if (Auth::check()) {
     
            // Redirect authenticated users based on their role
            if (Auth::user()->hasRole(['admin', 'Admin', 'superadmin'])) {
                return redirect('/admin');
                // return $next($request);
            } else {
                return redirect('/user/profile');
            }
        
        }
        return $next($request);
    }
}
