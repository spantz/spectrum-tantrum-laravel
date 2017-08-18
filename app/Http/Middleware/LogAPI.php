<?php

namespace App\Http\Middleware;

use App\Models\Log;
use App\Models\User;
use Closure;
use Laracore\Factory\ModelFactory;
use Laracore\Repository\ModelRepository;

class LogAPI
{
    /**
     * @var ModelFactory
     */
    private $factory;

    public function __construct(ModelFactory $factory)
    {
        $factory->setRepository(new ModelRepository(Log::class));
        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response =  $next($request);

        /** @var User $user */
        $user = $request->user();
        if (!is_null($user) && $user->hasActiveDevice()) {
            $this->factory->make([
                'device_id' => $user->getActiveDeviceId(),
                'endpoint' => $request->path(),
            ]);
        }

        return $response;
    }
}