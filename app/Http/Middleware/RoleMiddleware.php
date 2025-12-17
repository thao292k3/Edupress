<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check() && Auth::user()->role == $role) {
       
        if (Auth::user()->status === '0') {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('error', 'Tài khoản chưa được kích hoạt.');
        }
        return $next($request);
    }

    abort(403, 'Unauthorized action.');
    }
}
