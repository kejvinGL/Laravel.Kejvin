<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (auth()->user()?->role->name == $role) {
            return $next($request);
        } else {
            return \response()->json([
                "status" => 'failure',
                'message' => 'User not authorised to access this route [' . auth()->user()?->role->name . ']',

            ], Response::HTTP_FORBIDDEN);
        }
    }
}
