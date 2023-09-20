<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Staffmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard')->with('error', 'You have not staff access');
            } else if (Auth::user()->role_id == 3 || Auth::user()->role_id == 4) {
                return redirect()->route('doctor.dashboard')->with('error', 'You have not staff access');
            }
        }
        return $next($request);
    }
}
