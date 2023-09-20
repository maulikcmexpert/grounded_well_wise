<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminDoctorMiddleware
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
                return redirect()->route('admin.dashboard')->with('error', 'You have not doctor access');
            } else if (Auth::user()->role_id == 2) {
                return redirect()->route('staff.dashboard')->with('error', 'You have not doctor access');
            }
        }

        return $next($request);
    }
}
