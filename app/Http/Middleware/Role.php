<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Check if user has the required role
        // foreach ($roles as $role) {
        //     if (strtolower($request->user()->role->name) === strtolower($role)) {
                return $next($request);
        //     }
        // }

        // User doesn't have the required role, redirect or abort as needed
        return abort(403, 'Unauthorized');
    }
}
