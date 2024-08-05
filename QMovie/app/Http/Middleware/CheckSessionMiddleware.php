<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('key')) {
            Log::info('Session key found: ' . $request->session()->get('key'));
        } else {
            Log::info('Session key not found');
        }
        return $next($request);
    }
}