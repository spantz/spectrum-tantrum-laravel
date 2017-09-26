<?php

namespace App\Http\Middleware;

use App\Http\RouteConstants;
use Closure;
use Illuminate\Auth\AuthManager;

class RedirectIfAuthenticated
{
    private $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

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
        if ($this->auth->guard($guard)->check()) {
            return redirect()->route(RouteConstants::DASHBOARD);
        }

        return $next($request);
    }
}
