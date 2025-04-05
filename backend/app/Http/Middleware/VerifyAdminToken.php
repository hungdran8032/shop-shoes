<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAdminToken
{
    public function handle(Request $request, Closure $next)
    {
        $authorizationHeader = $request->header('Authorization');

        if (!$authorizationHeader || !preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
            return response()->json(['message' => 'Access Denied. No token provided'], 401);
        }

        $token = $matches[1];
        $jwtSecret = env('JWT_SECRET_KEY');

        try {
            $decoded = JWT::decode($token, new Key($jwtSecret, 'HS256'));
            $request->merge(['user' => (array) $decoded]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Invalid credentials'], 403);
        }

        return $next($request);
    }
}