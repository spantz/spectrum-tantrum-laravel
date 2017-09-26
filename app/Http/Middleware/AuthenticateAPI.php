<?php

namespace App\Http\Middleware;

use App\Util\TokenUtil;
use App\Models\Device;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laracore\Repository\ModelRepository;

class AuthenticateAPI
{
    private $repository;

    function __construct(ModelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->header('Authorization')) {
            return response('No auth token detected. Access forbidden.', 403);
        } else {
            try {
                $decryptedToken = TokenUtil::decryptToken($request->header('Authorization'));
            } catch (Exception $ex) {
                return response('Invalid auth token. Access forbidden.', 403);
            }

            $explodedToken = explode(TokenUtil::DELIMITER, $decryptedToken);

            $tokenType = $explodedToken[TokenUtil::TYPE_INDEX];
            $id = $explodedToken[TokenUtil::ID_INDEX];
            $timestamp = $explodedToken[TokenUtil::TIMESTAMP_INDEX];

            if ($tokenType === TokenUtil::DEVICE) {

                $this->repository->setModel(Device::class);

                /** @var Device $device */
                $device = $this->repository
                    ->query()
                    ->with('user')
                    ->where([
                        ['created_at', '=', $timestamp],
                        ['id', '=', $id]
                    ])
                    ->first();

                if (!$device) {
                    return response('Invalid auth token. Access forbidden.', 403);
                } else {
                    $user = $device->user;
                    $user->setActiveDevice($device);
                    Auth::login($user);
                    return $next($request);
                }
            } elseif ($tokenType === TokenUtil::USER) {

                $this->repository->setModel(User::class);

                /** @var User $user */
                $user = $this->repository
                    ->query()
                    ->where([
                        ['created_at', '=', $timestamp],
                        ['id', '=', $id]
                    ])
                    ->first();

                if (!$user) {
                    return response('Invalid auth token. Access forbidden.', 403);
                } else {
                    Auth::login($user);
                    return $next($request);
                }
            }
        }
    }
}