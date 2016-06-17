<?php

namespace App\Http\Middleware;

use CatLab\Gatekeeper\Laravel\Models\UserIdentity;
use Closure;
use Illuminate\Support\Facades\Auth;
use Gatekeeper;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        // Register ourselves with the Gatekeeper
        Gatekeeper::setIdentity(function() { return new UserIdentity(Auth::user()); });

        return $next($request);
    }
}
