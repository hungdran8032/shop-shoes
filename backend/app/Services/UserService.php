<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data)
    {
        $existingUser = $this->userRepository->findByEmail($data['email']);
        if ($existingUser) {
            throw new \Exception('User đã tồn tại', 400);
        }

        $data['role'] = 'user';
        return $this->userRepository->create($data);
    }

    public function updateUser($email, array $data)
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new \Exception('User không tồn tại', 404);
        }

        return $this->userRepository->update($user, $data);
    }

    public function getUser($email)
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new \Exception('Không tìm thấy người dùng', 404);
        }
        return $user;
    }

    public function updateUserRole($email, $role)
    {
        if (!in_array($role, ['user', 'admin'])) {
            throw new \Exception('Vai trò không hợp lệ', 400);
        }

        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new \Exception('Không tìm thấy người dùng', 404);
        }

        return $this->userRepository->update($user, ['role' => $role]);
    }

    public function loginAdmin($email, $password)
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user || $user->password !== $password) {
            throw new \Exception('Thông tin đăng nhập không hợp lệ', 401);
        }

        return $user;
    }
}