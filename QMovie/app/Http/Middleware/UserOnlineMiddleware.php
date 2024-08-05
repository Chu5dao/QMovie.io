<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class UserOnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        Log::info('UserOnlineMiddleware handle method called');
        $sessionId = session()->getId();
        if (!$sessionId) {
            Log::error('No session found');
            return $next($request);
        }
        
        Redis::setex('online-users:' . $sessionId, 600, true);
        Log::info('Session added to Redis: ' . $sessionId . ' with TTL: ' . Redis::ttl('online-users:' . $sessionId));
        return $next($request);
    }

    public function terminate($request, $response)
    {
        Log::info('UserOnlineMiddleware terminate method called');
        $sessionId = session()->getId();
        if (!$sessionId) {
            Log::error('No session found in terminate');
            return;
        }
        
        Redis::del('online-users:' . $sessionId);
        Log::info('Session removed from Redis: ' . $sessionId);
        event(new \App\Events\UpdateOnlineUsers());
    }
}
