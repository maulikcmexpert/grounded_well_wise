<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DynamicMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role_id == 1) {
            return app(Adminmiddleware::class)->handle($request, $next);
        } elseif (Auth::user()->role_id == 2) {
            return app(Staffmiddleware::class)->handle($request, $next);
        } else {
            return app(adminDoctorMiddleware::class)->handle($request, $next);
        }
    }
}
