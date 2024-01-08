<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequests
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
        Log::info('Request Path: ' . $request->path());
        Log::info('Request Method: ' . $request->method());
        Log::info('Request IP: ' . $request->ip());
        Log::info('Request Parameters: ' . json_encode($request->all()));
        return $next($request);

        Log::info('Response Status Code: ' . $response->status());

        return $response;
    }
}
