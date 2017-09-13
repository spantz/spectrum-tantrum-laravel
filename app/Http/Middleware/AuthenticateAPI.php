<?php

namespace App\Http\Middleware;

use App\Http\TokenConstants;
use App\Models\Device;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Exception;

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
            try {
                $decryptedToken = decrypt($request->auth_token);
            }
            catch(Exception $ex) {
                return response('Invalid auth token. Access forbidden.', 403);
            }

            $explodedToken = explode(TokenConstants::DELIMITER, $decryptedToken);

            $tokenType = $explodedToken[TokenConstants::TYPE_INDEX];
            $id = $explodedToken[TokenConstants::ID_INDEX];
            $timestamp = $explodedToken[TokenConstants::TIMESTAMP_INDEX];

            if($tokenType === TokenConstants::DEVICE) {
                /** @var Device $device */
                $device = Device::with('user')
                    ->where([
                        ['created_at', '=', $timestamp],
                        ['id', '=', $id]
                    ])
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
            elseif($tokenType === TokenConstants::USER){
                /** @var User $user */
                $user = User::
                    where([
                        ['created_at', '=', $timestamp],
                        ['id', '=', $id]
                    ])
                    ->first();

                if(!$user) {
                    return response('Invalid auth token. Access forbidden.', 403);
                }
                else {
                    Auth::login($user);
                    return $next($request);
                }
            }
        }
    }
}