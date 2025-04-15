<?php
namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(Request $request)
    {
        $data = $request->only(['email', 'password']);
        return $this->userService->createUser($data);
    }

    public function getUser($email)
    {
        return $this->userService->getUser($email);
    }

    public function updateUserRole(Request $request, $email)
    {
        return $this->userService->updateUserRole($email, $request->input('role'));
    }

    public function loginAdmin(Request $request)
    {
        try {
            $user = $this->userService->loginAdmin($request->input('email'), $request->input('password'));
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'Authentication successful',
                'token' => $token,
                'user' => ['email' => $user->email, 'role' => $user->role]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 401);
        }
    }
}