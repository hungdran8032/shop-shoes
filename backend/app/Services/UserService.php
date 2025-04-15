<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function createUser($data)
    {
        $existingUser = $this->userRepo->findByEmail($data['email']);
        if ($existingUser) {
            return response()->json(['message' => 'User đã tồn tại'], 400);
        }

        $user = $this->userRepo->createUser($data);
        return response()->json($user, 201);
    }

    public function getUser($email)
    {
        $user = $this->userRepo->findByEmail($email);
        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy người dùng'], 404);
        }
        return response()->json($user);
    }

    public function updateUserRole($email, $role)
    {
        if (!in_array($role, ['user', 'admin'])) {
            return response()->json(['message' => 'Vai trò không hợp lệ'], 400);
        }

        $user = $this->userRepo->findByEmail($email);
        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy người dùng'], 404);
        }

        $updated = $this->userRepo->updateRole($user, $role);
        return response()->json(['message' => 'Cập nhật vai trò thành công', 'user' => $updated]);
    }

    public function loginAdmin($email, $password)
    {
        $user = $this->userRepo->findByEmail($email);
        if (!$user || $user->password !== $password) {
            throw new \Exception('Thông tin đăng nhập không hợp lệ', 401);
        }

        return $user;
    }
}