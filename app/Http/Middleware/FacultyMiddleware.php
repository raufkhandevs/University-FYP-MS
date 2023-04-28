<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (($user = auth()->user()) && (!$user->hasRole(Role::ROLE_STUDENT))) {
                return $next($request);
            }
            return redirect()->route('dashboard')->with('warning_message', 'Access Denied');
        }
        return redirect()->route('login')->with('error_message', 'Login First');
    }
}
