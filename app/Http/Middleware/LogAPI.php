<?php

namespace App\Http\Middleware;

use App\Models\Log;
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

        $factory->make([
            'device_id' => $request->device_id,
            'endpoint' => $request->fullUrl(),
        ]);

        return $response;
    }
}