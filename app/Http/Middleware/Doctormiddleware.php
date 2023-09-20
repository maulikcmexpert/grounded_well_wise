<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\BaseController as BaseController;

class Doctormiddleware  extends BaseController
{
    /**
     * Handle an incoming request.
     *
     * @param
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('api')->check()) {
            return $this->sendErroriftokenFalse('Unauthenticated  ', ['error' => 'Unauthenticated']);
        }

        if (Auth::guard('api')->user()->role_id == 4 || Auth::guard('api')->user()->role_id == 3) {
            return $next($request);
        } else {
            return $this->sendErroriftokenFalse('Unauthenticated', ['error' => 'Unauthenticated']);
        }
    }
}
