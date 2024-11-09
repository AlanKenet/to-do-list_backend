<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');

        $expectedToken = env('API_TOKEN');

        if (!$token || $token !== $expectedToken) {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 403
            ], 403);
        }

        return $next($request);
    }
}
