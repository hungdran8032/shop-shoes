<?php
namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(CreateUserRequest $request)
    {
        try {
            $user = $this->userService->createUser($request->validated());
            return response()->json($user, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $user = $this->userService->updateUser($request->input('email'), $request->validated());
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function get($email)
    {
        try {
            $user = $this->userService->getUser($email);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function updateRole($email, UpdateUserRoleRequest $request)
    {
        try {
            $user = $this->userService->updateUserRole($email, $request->input('role'));
            return response()->json(['message' => 'Cập nhật vai trò thành công', 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
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