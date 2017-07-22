<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->has('auth_token')) {
            return response('No auth token detected. Access forbidden.', 403);
        }
        else {
            $device = \DB::table('devices')
                ->where('auth_token', '=', $request->auth_token)
                ->first();

            if(!$device) {
                return response('Invalid auth token. Access forbidden.', 403);
            } else {
                Auth::loginUsingId($device->user_id);
                return $next($request);
            }
        }
    }
}