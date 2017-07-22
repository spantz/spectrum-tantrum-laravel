<?php

namespace App\Http\Middleware;

use App\Models\Device;
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
            /** @var Device $device */
            $device = Device::with('user')
                ->where('auth_token', '=', $request->auth_token)
                ->first();

            if(!$device) {
                return response('Invalid auth token. Access forbidden.', 403);
            } else {
                $user = $device->user;
                $user->setActiveDevice($device);
                Auth::login($user);
                return $next($request);
            }
        }
    }
}