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
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response =  $next($request);

        $factory = new ModelFactory(Log::class);
        $factory->setRepository(new ModelRepository(Log::class));

        /** @var User $user */
        $user = $request->user();

        $factory->make([
            'device_id' => $user->getActiveDevice()->id,
            'endpoint' => $request->fullUrl(),
        ]);

        return $response;
    }
}