<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Gantilah dengan API key yang valid
        $validApiKey = 'dewa';
        
        $apiKey = $request->header('x-api-key');

        if (!$apiKey) {
            return response()->json(['message' => 'API key is missing'], 401);
        }

        if ($apiKey !== $validApiKey) {
            return response()->json(['message' => 'Invalid API key'], 403);
        }

        return $next($request);
    }
}
