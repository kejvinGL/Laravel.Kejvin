<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (ApiKey::where('value', $request->header('x-api-key'))->exists()) {
            return $next($request);
        } else {
            return \response()->json([
                "status" => 'failure',
                'message' => 'API Key invalid'
            ], 403);
        }
    }
}
