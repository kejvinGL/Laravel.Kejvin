<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (auth()->user()->role->id == 1) {
            return $next($request);
        } else {
            return \response()->json([
                "status" => 'failure',
                'message' => 'User not authorised to access this route'
            ], 403);
        }
    }
}
