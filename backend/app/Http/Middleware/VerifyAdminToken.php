<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyAdminToken
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $request->attributes->add(['user' => $user]);
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid credentials'], 403);
        }
    }
}