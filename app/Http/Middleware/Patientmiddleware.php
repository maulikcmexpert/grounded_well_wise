<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;


class Patientmiddleware extends BaseController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('api')->check()) {
            return $this->sendErroriftokenFalse('Unauthenticated  ', ['error' => 'Unauthenticated']);
        }

        if (Auth::guard('api')->user()->role_id == 5) {
            if (Auth::guard('api')->user()->status == '1') {

                return $next($request);
            }
            return $this->sendErroriftokenFalse('Unauthenticated  ', ['error' => 'Unauthenticated']);
        } else {
            return $this->sendErroriftokenFalse('token is invalid', ['error' => 'Unauthenticated']);
        }
    }
}
